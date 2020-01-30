<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blacklist;
use Validator;

use Route;

class BlacklistController extends Controller
{
     /*
    	Blacklist page
     */
    
    public function blacklistPage() {

    	$view = view("pages.dashboard.manageblacklist.index");

    	$blacklist_items = Blacklist::all();

    	$view->blacklist_items = $blacklist_items;
    	$view->currentPath = Route::getCurrentRoute()->uri();

    	return $view;
    }

    public function addDomainPage() {

    	$view = view("pages.dashboard.manageblacklist.add-domain");

    	$view->currentPath = Route::getCurrentRoute()->uri();

    	return $view;
    }

    public function addDomain(Request $request) {

    	$view = view("pages.dashboard.manageblacklist.add-domain");

    	$rules = [
    	     'domain' => ['required'],	
	    ];

	    $messages = [
	        'required' => 'You have to enter a Domain.',
	    ];

	    $validator = Validator::make($request->input(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("blacklistnewdomain")
                        ->withErrors($validator)->withInput();
        }

    	$domain = new Blacklist;

    	$domain->domain = $request->input('domain');

    	$domain->save();


    	return redirect()->route('manageblacklist')->with('success', 'Domain blacklisted!');
    }

    public function deleteDomain($id) {
    	$shortlink = Blacklist::find($id);

    	$shortlink->delete();

    	return redirect()->route('manageblacklist')->with('success', 'Domain deleted!');

    }
}
