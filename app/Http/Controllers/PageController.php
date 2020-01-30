<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use Route;
use Auth;


class PageController extends Controller
{
    public function phpinfo() {
        phpinfo();
    }

    public function home() {
    	$view = view("pages.home");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    // Login page
    public function loginPage() {
    	$view = view("pages.login");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function authenticate(Request $request) {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            
            // Check if user is active
            if(!Auth::user()->active) {
                Auth::logout();
                return redirect()->route('userlogin')->with('error', 'Fedt at se du er så ivrig at komme igang! Men vi har brug for at du bekræfter din e-mail.');
            }

            // Authentication passed...
            return redirect()->intended()->with('success', 'Velkommen tilbage!');
        }

        return redirect()->route('userlogin')->withInput()->with('error', 'Log ind mislykkedes. Tjek om du har indtastet de rigtige informationer.');

    }

    public function logout() {
        Auth::logout();

        return redirect()->route('home')->with('status', "Du blev logget ud.");
    }

    public function buyPremiumPage(Request $request) {
        $view = view("pages.getpremium");
        
        $view->currentPath = Route::getCurrentRoute()->uri();
        
        return $view;
    }

    public function viewPage($page, $request) {
        $view = view("pages.static.".$page);
        
        $view->currentPath = Route::getCurrentRoute()->uri();
        
        return $view;
    }


    public function ideaRedirect() {
        return redirect('https://docs.google.com/forms/d/1i4ywxizMPH8MbyTZzRCyeXCvhVbCuUmK5lhzoPH07vo/edit#responses');
    }
}
