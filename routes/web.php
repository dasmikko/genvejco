<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;

$domain = 'genvej.co';

if(env('APP_ENV') == 'local')
	$domain = 'genvejco.app';

if(env('APP_ENV') == 'testserver')
	$domain = 'genvejcotest.danskkodning.dk';


Route::group(['domain' => 'dash.'.$domain, ], function () {
    

    Route::get('/login', 'DashboardController@loginPage')->name('dashboardLogin');
    Route::post('/login', 'DashboardController@authenticate');

    Route::get('/logout', 'DashboardController@logout');

    Route::group(['middleware' => ['checkrole'] ], function() {
    	Route::get('/', 'DashboardController@dashboardPage')->name('dashboard');
    
	    Route::get('/manageshortlinks', 'ShortlinkController@manageShortlinksPage')->name('manageShortlinks');
	    Route::get('/manageshortlinks/delete/{id}', 'ShortlinkController@deleteShortlink');
	    Route::get('/shortlink/stats/{id}', 'ShortlinkController@viewShortlinkStats')->name('viewshortlinkstats');

	 	Route::get('/manageblacklist', 'BlacklistController@blacklistPage')->name('manageblacklist');
	 	Route::get('/manageblacklist/add', 'BlacklistController@addDomainPage')->name('blacklistnewdomain');
	 	Route::post('/manageblacklist/add', 'BlacklistController@addDomain');
	 	Route::get('/manageblacklist/delete/{id}', 'BlacklistController@deleteDomain');

	 	Route::get('/manageusers', 'UserController@userPage')->name('manageusers');
	 	Route::get('/manageusers/add', 'UserController@addUserPage')->name('newuserpage');
	 	Route::post('/manageusers/add', 'UserController@addUser');
	 	Route::get('/manageusers/edit/{id}', 'UserController@editUserPage')->name('edituserpage');
	 	Route::post('/manageusers/update/{id}', 'UserController@updateUser');
	 	Route::get('/manageusers/delete/{id}', 'UserController@deleteUser');

 	});

});

/**
 * Control panel
 */
Route::group(['domain' => 'controlpanel.'.$domain, 'middleware' => 'auth.isloggedin' ], function () { 

	Route::get('/', 'ControlPanelController@indexPage')->name('controlpanel');
	Route::get('/settings', 'UserController@settingsPage')->name('controlpanelSettings');

    Route::get('/generateapikey', 'UserController@generateApiKey')->name('generateapikey');

	Route::get('/settings/email', 'UserController@emailPage')->name('controlpanelSettingsEmail');
	Route::post('/settings/email', 'UserController@updateEmail');

	Route::get('/settings/password', 'UserController@passwordPage')->name('controlpanelSettingsPassword');
	Route::post('/settings/password', 'UserController@updatePassword');

	Route::get('/settings/updatecard', 'UserController@updateCardPage')->name('controlpanelSettingsUpdateCard');
	Route::post('/settings/updatecard', 'UserController@updateCard');

	Route::get('/shortlink/delete/{id}', 'ShortlinkController@deactivateShortlink');

	Route::get('/shortlink-links', 'ControlPanelController@shortlinkLinksPage')->name('controlpanelShortlinkLinks');

	Route::group(['middleware' => 'auth.ispremiumuser'], function () {
	    Route::get('/shortlink/stats/{id}', 'ControlPanelPremiumController@viewShortlinkStats')->name('userViewShortlinkStats');
	});
	
	Route::get('/cancelsubscriptiion', 'UserController@cancelSubscription')->name('controlpanelcancelsubscription');

	Route::get('/shortlinklink/delete/{id}', 'ShortlinkController@deleteShortlinkLink')->name('shortlinklinkdelete');

	Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
	    return $request->user()->downloadInvoice($invoiceId, [
	    	'street' 	=> 'LolStreet',
	    	'location' 	=> nl2br('Jespers adresse <br>Postnr, by<br>Adresse'),
	    	'url' 		=> route('home'),
	    	'phone' 	=> '12 34 56 78',
	    	'vat' 		=> 'Moms: 25%',
	        'vendor'  	=> 'Genvej.co',
	        'product' 	=> 'Premium',
	    ]);
	});

	Route::get('settings/invoices', 'UserController@invoicesPage')->name('controlpanelSettingsInvoices');


});


Route::group(['domain' => $domain, ], function () {

	//Route::get('/phpinfo', 'PageController@phpinfo');

	Route::get('/', 'PageController@home')->name('home');

	Route::post('/', 'ShortlinkController@createShortlink');



	Route::get('/login', 'PageController@loginPage')->name('userlogin');
    Route::post('/login', 'PageController@authenticate');
	Route::get('/logout', 'PageController@logout')->name('userlogout');

	Route::get('/register', 'UserController@registerPage')->name("register");
	Route::post('/register', 'UserController@register');

	Route::get('/forgotpassword', 'UserController@forgotpasswordPage')->name("forgotpassword");
	Route::post('/forgotpassword', 'UserController@sendResetPasswordMail');
	
	Route::get('/resetpassword/{token}', 'UserController@resetpasswordPage')->name("resetpassword");
	Route::post('/resetpassword/{token}', 'UserController@resetPassword');

	Route::get('/activate/{token}', 'UserController@activateAccount')->name("activateAccount");

	Route::get('/buypremium', 'PageController@buyPremiumPage')->name("buypremium");
	Route::post('/buypremium', 'UserController@buyPremiumHandle')->name("handleBuyPremium");

	Route::post(
		'stripe/webhook',
		'StripeController@handleWebhook'
	);



	Route::get('/{page}', function ($page, Request $request) {
	    // Check if view for page exists, or else its a shortlink
	    if (View::exists('pages.static.'.$page)) {
    	 	return App::make("App\Http\Controllers\PageController")->viewPage($page, $request);
	    } else {
	    	return App::make("App\Http\Controllers\ShortlinkController")->viewShortlink($page, $request);
	    }
	});

	//Route::get('/{id}', 'ShortlinkController@viewShortlink');

});

