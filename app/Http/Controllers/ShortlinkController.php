<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shortlink;
use App\ShortlinkView;
use App\Blacklist;
use App\ShortlinkLink;
use App\User;
use Validator;
use Auth;
use Route;
use View;
use DB;


class ShortlinkController extends Controller
{
    public function createShortlink(Request $request) {

        // Add Http if it's missing
        if (strpos($request->input('url'), 'http://') === false && strpos($request->input('url'), 'https://') === false) {
            $request->merge(array('url' => "http://".$request->input('url') ));
        }


        // If using custom id, don't return for existing url in db or else return the shortlink
        if($request->input('custom_id') != null && Auth::check()) {

            $existing_shortlink = Shortlink::where('shortlink_id', $request->input('custom_id'))
                                             ->where('active', true)
                                             ->where('is_custom', true)
                                             ->first();
            
            // if found existing shortlink with custom id
            if($existing_shortlink) {
                $flashdata = array(
                    'shortlink-error' => "Kortlink navn er allerede taget.",
                );

                return redirect('/')->with($flashdata);
            }

        } else {

            // Find existing shortling
            $existing_shortlink = Shortlink::where('url', $request->input('url'))
                                             ->where('active', 1)
                                             ->where('is_custom', false)
                                             ->first();

            // if found existing shortlink, return it!
            if($existing_shortlink) {
                // Create link to the shortlink
                $shortlinkLink = new ShortlinkLink;
                $shortlinkLink->user_id = Auth::user()->id;
                $shortlinkLink->shortlink_id = $existing_shortlink->shortlink_id;
                $shortlinkLink->save();

                $flashdata = array(
                    'status' => "Kortlink link oprettet!",
                    'shortlink_id' => $existing_shortlink->shortlink_id,
                );

                return redirect('/')->with($flashdata);
            }

        }

        // If using custom id, don't return for existing url in db
        if($request->input('custom_id') != null && Auth::check()) {

            // Only check count for users            
            if(Auth::user()->role == 2) {

                // Get total amount of custom shortlinks
                $customIdLinksCount = Shortlink::where('user_id', Auth::user()->id)
                                                ->where('active', true)
                                                ->where('is_custom', true)->count();

                // Check if user reached their limit
                if($customIdLinksCount >= Auth::user()->max_custom_links) {
                    $flashdata = array(
                        'shortlink-error' => "Ups! Du har nået din grænse for kortlinks med eget navn. Slet en eksisterende selv navngivet kortlink, og derefter kan du lave et nyt navngivet kortlink."
                    );

                    return redirect('/')->with($flashdata);
                }

            }



        }
            




        // Validation
    	$rules = [
    	     'url' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],	
             'custom_id' => ['min:5', 'alpha_num']
	    ];

	    $messages = [
	        'required'         => 'Du skal indtaste en URL, prøv igen.',
	        'url.regex'        => 'URL\'en du indtastede var ikke gyldig. Måske manglede du "www."',
            'min'              => 'Kortlink navn skal være på minimum 5 tegn!',
            'custom_id.regex'  => 'Kortlink navn må ikke indeholde specialtegn eller mellemrum',
            'custom_id.alpha_num'  => 'TalKortlink navn må ikke indeholde specialtegn eller mellemrum'
	    ];

        // Rule for admins, make very short shortlinks
        if (Auth::check()) {
            if(Auth::user()->role == 1) {
                $rules['custom_id'] = ['min:1', 'alpha_num'];
            }
        }

	    $validator = Validator::make($request->input(), $rules, $messages);

	    if ($validator->fails()) {
	        return redirect('/')
	                    ->withErrors($validator)->withInput();
	    }	


        
        // Get domain of link, and check if blacklisted
        $domain = parse_url($request->input('url'));
        $domain = preg_replace("/www./", "", $domain["host"]);
        $domain = preg_replace("/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/", "", $domain);
        $is_blacklisted_domain = Blacklist::where('domain', $domain)->count();

        if($is_blacklisted_domain > 0) {
            return redirect('/')->with('shortlink-error', "Domænet er blacklistet!");
        }

        // Create new shortlink
    	$shortlink = new Shortlink;

        // Add user id if logged in.
        if(Auth::check())
        {
            $shortlink->user_id = Auth::user()->id;


        }

    	$shortlink->url = $request->input('url');
    	$shortlink->ip = $request->ip();


        // Use custom id if user has entered one
        if($request->input('custom_id') != null && Auth::check()) {
            $shortlink->shortlink_id = $request->input('custom_id');
            $shortlink->is_custom = true;
        } else {
        	// Generate unique ID
        	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	    $charactersLength = strlen($characters);
    	    $randomString = '';
    	    for ($i = 0; $i < 5; $i++) {
    	        $randomString .= $characters[rand(0, $charactersLength - 1)];
    	    }

        	$shortlink->shortlink_id = $randomString;
        }

    	$shortlink->save();

    	$flashdata = array(
    		'status' => "Kortlink oprettet",
    		'shortlink_id' => $shortlink->shortlink_id,
		);

    	return redirect('/')->with($flashdata);

    }

    public function viewShortlink($shortlink_id, Request $request) {
    	$shortlink = Shortlink::where('shortlink_id', $shortlink_id)->first();

    	if(!$shortlink) {
            abort(404);
    		return redirect('/')->with('shortlink-error', "Kortlink eksisterer ikke!");
    	}

        // Add shortlink view if it's not viewed from dashboard
        if(!strpos($request->server('HTTP_REFERER'), 'dash.genvej') ) {
         

            $shortlink_view = new ShortlinkView;

            $shortlink_view->shortlink_id = $shortlink->id;
            $shortlink_view->useragent = $request->server('HTTP_USER_AGENT');

       

            if($request->server('HTTP_REFERER') == null) {
                $shortlink_view->referer = "Direct";
            } else {
                $shortlink_view->referer = $request->server('HTTP_REFERER');    
            }
        
            $shortlink_view->ip = $request->ip();

            $shortlink_view->save();

        }

    	return redirect($shortlink->url);

    }



    /*
     * Manage shortlinks
     */
    
    public function manageShortlinksPage(Request $request) {

        $view = view("pages.dashboard.manageshortlinks.index");


        if($request->sort) {
            $shortlinks = Shortlink::withCount('shortlinkViews')
                ->orderBy($request->column, $request->sort)->get();
        } else {
            $shortlinks = Shortlink::all();
        }

        $view->shortlinks = $shortlinks;
        $view->sortColumn = $request->column;
        $view->sortOrder = $request->sort;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function deleteShortlink($id) {
        $shortlink = Shortlink::find($id);

        $shortlink->delete();

        return redirect()->route('manageShortlinks')->with('success', 'Shortlink deleted!');

    }


    public function deactivateShortlink($id) {
        $shortlink = Shortlink::find($id);

        $shortlink->active = 0;

        $shortlink->save();

        return redirect()->route('controlpanel')->with('success', 'Kortlink slettet!');

    }

    public function deleteShortlinkLink($id) {
        $shortlink = ShortlinkLink::find($id)->first();

        $shortlink->delete();

        return redirect()->route('controlpanel')->with('success', 'Kortlink link slettet!');
    }



    public function viewShortlinkStats($id, Request $request) {
        $view = view("pages.dashboard.manageshortlinks.viewstats");

        $shortlink = Shortlink::find($id);
        $refererlist = DB::table('shortlink_views')
                         ->select('*', DB::raw('count(referer) as total'))
                         ->where('shortlink_id', $id)
                         ->groupBy('referer')
                         ->orderBy('total', 'desc')
                         ->get();


        $view->shortlink = $shortlink;
        $view->refererlist = $refererlist;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function apiShortlinks(Request $request) {
        $apitoken = $request->get('token');

        $user = User::where('apitoken', $apitoken)->first();
        $shortlinks = Shortlink::where('user_id', $user->id)->get();
        return $shortlinks->toJson();
    }

    /**
     * params:
     * url, custom_id
     */
    public function apiCreateShortlink(Request $request) {
        $apitoken = $request->get('token');

        $user = User::where('apitoken', $apitoken)->first();

        if($user == null) {
            $result = [
                'status' => 0,
                'message' => 'Invalid token',
            ];

            return json_encode($result);
        }

        // Add Http if it's missing
        if (strpos($request->get('url'), 'http://') === false && strpos($request->get('url'), 'https://') === false) {
            $request->merge(array('url' => "http://".$request->get('url') ));
        }


        // If using custom id, don't return for existing url in db or else return the shortlink
        if($request->get('custom_id') != null) {

            $existing_shortlink = Shortlink::where('shortlink_id', $request->input('custom_id'))
                ->where('active', true)
                ->where('is_custom', true)
                ->first();

            // if found existing shortlink with custom id
            if($existing_shortlink) {
                $result = [
                    'status' => 100,
                    'message' => 'Shortlink name already taken',
                ];

                return json_encode($result);
            }

        } else {

            // Find existing shortling
            $existing_shortlink = Shortlink::where('url', $request->get('url'))
                ->where('active', 1)
                ->where('is_custom', false)
                ->first();

            // if found existing shortlink, return it!
            if($existing_shortlink) {
                // Create link to the shortlink
                $shortlinkLink = new ShortlinkLink;
                $shortlinkLink->user_id = $user->id;
                $shortlinkLink->shortlink_id = $existing_shortlink->shortlink_id;
                $shortlinkLink->save();

                $result = [
                    'status' => 1,
                    'message' => "Kortlink link oprettet!",
                    'shortlink_id' => $existing_shortlink->shortlink_id,
                ];

                return json_encode($result);
            }

        }

        // If using custom id, don't return for existing url in db
        if($request->get('custom_id') != null) {

            // Only check count for users
            if($user->role == 2) {

                // Get total amount of custom shortlinks
                $customIdLinksCount = Shortlink::where('user_id', $user->id)
                    ->where('active', true)
                    ->where('is_custom', true)->count();

                // Check if user reached their limit
                if($customIdLinksCount >= $user->max_custom_links) {
                    $result = [
                        'status' => 101,
                        'message' => "Whoops! You have reached your limit of shortlinks with custom name. remove existing shortlinks with custom names, and try again.",
                        'shortlink_id' => $existing_shortlink->shortlink_id,
                    ];

                    return json_encode($result);
                }

            }



        }


        // Validation
        $rules = [
            'url' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
            'custom_id' => ['min:5', 'alpha_num']
        ];

        $messages = [
            'required'         => 'Du skal indtaste en URL, prøv igen.',
            'url.regex'        => 'URL\'en du indtastede var ikke gyldig. Måske manglede du "www."',
            'min'              => 'Kortlink navn skal være på minimum 5 tegn!',
            'custom_id.regex'  => 'Kortlink navn må ikke indeholde specialtegn eller mellemrum',
            'custom_id.alpha_num'  => 'TalKortlink navn må ikke indeholde specialtegn eller mellemrum'
        ];

        // Rule for admins, make very short shortlinks
        if($user->role == 1) {
            $rules['custom_id'] = ['min:1', 'alpha_num'];
        }

        $fields = [
            'url' =>  $request->get('url'),
            'custom_id' => $request->get('custom_id')
        ];

        $validator = Validator::make($fields, $rules, $messages);

        if ($validator->fails()) {
            $result = [
                'status' => 102,
                'message' => $validator,
            ];

            return json_encode($result);
        }



        // Get domain of link, and check if blacklisted
        $domain = parse_url($request->input('url'));
        $domain = preg_replace("/www./", "", $domain["host"]);
        $domain = preg_replace("/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/", "", $domain);
        $is_blacklisted_domain = Blacklist::where('domain', $domain)->count();

        if($is_blacklisted_domain > 0) {
            return redirect('/')->with('shortlink-error', "Domænet er blacklistet!");
        }

        // Create new shortlink
        $shortlink = new Shortlink;

        // Add user id if logged in.
        if($user != null)
        {
            $shortlink->user_id = $user->id;


        }

        $shortlink->url = $request->input('url');
        $shortlink->ip = $request->ip();


        // Use custom id if user has entered one
        if($request->input('custom_id') != null && Auth::check()) {
            $shortlink->shortlink_id = $request->input('custom_id');
            $shortlink->is_custom = true;
        } else {
            // Generate unique ID
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $shortlink->shortlink_id = $randomString;
        }

        $shortlink->save();

        $result = [
            'status' => 1,
            'message' => "Shortlink created.",
            'shortlink_id' => $shortlink->shortlink_id,
        ];

        return json_encode($result);
    }

    public function apideleteShortlinkLink($id) {
        $apitoken = $request->get('token');

        $user = User::where('apitoken', $apitoken)->first();

        if($user == null) {
            $result = [
                'status' => 0,
                'message' => 'Invalid token',
            ];

            return json_encode($result);
        }

        $shortlink = ShortlinkLink::find($id)->first();

        $shortlink->delete();

        $result = [
            'status' => 1,
            'message' => 'Shortlink deleted',
        ];

        return json_encode($result);
    }

    public function apideactivateShortlink($id) {
        $shortlink = Shortlink::find($id);

        $shortlink->active = 0;

        $shortlink->save();

        return redirect()->route('controlpanel')->with('success', 'Kortlink slettet!');

    }


}
