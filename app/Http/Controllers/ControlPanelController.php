<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shortlink;
use App\ShortlinkView;
use App\ShortlinkLink;

use Auth;
use Route;

class ControlPanelController extends Controller
{
    public function indexPage(Request $request) {

        if(Auth::user()->role == 3 || Auth::user()->role == 1) {
            $view = view("pages.controlpanel.premium.home");
        } else {
            $view = view("pages.controlpanel.home");
        }
    	

    	$currentUser = Auth::user()->id;

        if($request->sort) {
            $user_shortlinks = Shortlink::withCount('shortlinkViews')->where("user_id", $currentUser)->where('active', 1)->orderBy($request->column, $request->sort)->paginate(5);
        } else {
            $user_shortlinks = Shortlink::withCount('shortlinkViews')->where("user_id", $currentUser)->where('active', 1)->orderBy('created_at', 'desc')
               ->paginate(5);
        }


        $user_shortlinkLinks = ShortlinkLink::where('user_id', $currentUser)->get();


        $view->paginationPage = $request->page;
        $view->sortColumn = $request->column;
        $view->sortOrder = $request->sort;
    	$view->user_shortlinks = $user_shortlinks;
        $view->user_shortlinkLinks = $user_shortlinkLinks;
    	$view->currentPath = Route::getCurrentRoute()->uri();

    	return $view;
    }

    // handle shortlink links page
    public function shortlinkLinksPage(Request $request) {
        $view = view("pages.controlpanel.shortlink-links");

        $currentUser = Auth::user()->id;

        if($request->sort) {
            $user_shortlinkLinks = ShortlinkLink::join('shortlinks as slinks', 'shortlink_links.shortlink_id', '=', 'slinks.shortlink_id')
                                                    ->select('shortlink_links.*', 'slinks.url as shortlink_url')
                                                    ->where("shortlink_links.user_id", $currentUser)
                                                    ->orderBy($request->column, $request->sort)->get();
        } else {
            $user_shortlinkLinks = ShortlinkLink::join('shortlinks as slinks', 'shortlink_links.shortlink_id', '=', 'slinks.shortlink_id')
                                ->select('shortlink_links.*', 'slinks.url as shortlink_url')
                                ->where("shortlink_links.user_id", $currentUser)->orderBy('created_at', 'desc')
                                ->get();
        }



        $view->paginationPage = $request->page;
        $view->sortColumn = $request->column;
        $view->sortOrder = $request->sort;
        $view->user_shortlinkLinks = $user_shortlinkLinks;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }
}
