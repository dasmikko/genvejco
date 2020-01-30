<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\Shortlink;
use App\ShortlinkView;
use App\Blacklist;
use App\User;
use Validator;
use Hash;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function dashboardPage() {

    	$view = view("pages.dashboard.home");


    	$popularShortlinks = ShortlinkView::select('*', \DB::raw('count(id) as views'))
                                             ->groupBy('shortlink_id')
                                             ->orderBy('views', 'desc')
                                             ->take(10)
                                             ->get();


       	$latestShortlinks = Shortlink::orderBy('created_at', 'desc')
               ->take(10)
               ->get();

    	$view->popularShortlinks = $popularShortlinks;
    	$view->latestShortlinks = $latestShortlinks;
    	$view->currentPath = Route::getCurrentRoute()->uri();

    	return $view;
    }



    public function loginPage() {

        $view = view("pages.dashboard.login");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function authenticate(Request $request) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed...
            return redirect()->intended();
        }

        return redirect()->route('dashboardLogin')->with('error', 'Log ind mislykkedes. Tjek om du har indtastet de rigtige informationer.');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('home');
    }

    


    


   



    





}
