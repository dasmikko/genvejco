<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use Auth;
use App\User;
use Validator;
use Hash;
use Carbon\Carbon;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\Welcome;
use App\Mail\ActivateAccount;
use App\Mail\ResetPasswordMail;
use App\Mail\ThanksForBuying;


class UserController extends Controller
{
    /*
        Manage users page
     */
    
    public function userPage() {

        $view = view("pages.dashboard.manageusers.index");

        $users = User::all();

        $view->users = $users;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function addUserPage() {

        $view = view("pages.dashboard.manageusers.add-user");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function addUser(Request $request) {

        $rules = [
             'username' => ['required', 'unique:users'],  
             'email' => ['required', 'email', 'unique:users'], 
             'password' => ['required'], 
             'max_custom_links' => ['required', 'numeric']
        ];

        $messages = [
            'required' => 'All fields are required.',
            'email' => 'Not a valid e-mail address.'
        ];

        $validator = Validator::make($request->input(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("edituserpage")
                        ->withErrors($validator)->withInput();
        }

        $user = new User;

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->max_custom_links = $request->max_custom_links;
        $user->active = $request->active;

        $user->save();


        return redirect()->route('manageusers')->with('success', 'User was created!');
    }

    public function editUserPage($id) {

        $view = view("pages.dashboard.manageusers.edit-user");

        $user = User::find($id);


        $view->user = $user;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;

    }

    public function updateUser($id, Request $request) {
        // Find user
        $user = User::find($id);

        // Validation rules
        $rules = [
             'username' => ['required', 'unique:users,username,'.$user->id],  
             'email' => ['required', 'email', 'unique:users,email,'.$user->id], 
             'max_custom_links' => ['required', 'numeric']
        ];

        // Custom messages
        $messages = [
            'required' => 'Username and E-mail are required.',
            'email' => 'Not a valid e-mail address.'
        ];

        // Run validation
        $validator = Validator::make($request->input(), $rules, $messages);

        // Check if failed
        if ($validator->fails()) {
            return redirect()->route("edituserpage", ['id' => $id])
                        ->withErrors($validator)->withInput();
        }

        // Update user info
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->active = $request->active;
        $user->max_custom_links = $request->max_custom_links;

        // Only update password if needed
        if($request->password != "") {
            $user->password = Hash::make($request->password);
        }

        // Save
        $user->save();

        // redirect!
        return redirect()->route('manageusers')->with('success', 'User updated!');

    }

    public function deleteUser($id) {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('manageusers')->with('success', 'User deleted!');

    }


    public function settingsPage() {
        $view = view("pages.controlpanel.settings.index");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function emailPage() {
        $view = view("pages.controlpanel.settings.email");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function updateEmail(Request $request) {
        $rules = [
             'email' => ['required', 'email', 'same:email-check'], 
             'email-check' => ['required', 'email'],
        ];

        $messages = [
            'email.required' => 'Feltet er påkrævet.',
            'email-check.required' => 'Du skal gentage din nye email.',
            'email.same' => 'De indtastede emails er ikke ens.',
            'email' => 'Du skal indtaste en gyldig email.',
        ];

        $validator = Validator::make($request->input(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("controlpanelSettingsEmail")
                        ->withErrors($validator)->withInput();
        }


        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->save();

        return redirect()->route("controlpanelSettings")->with('success', 'Email blev ændret!');;


    }





    public function passwordPage() {
        $view = view("pages.controlpanel.settings.password");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function updatePassword(Request $request) {
        $rules = [
             'password' => ['required', 'same:password-check'], 
             'password-check' => ['required'],
        ];

        $messages = [
            'password.required' => 'Feltet er påkrævet.',
            'password-check.required' => 'Du skal gentage dit nye kodeord.',
            'password.same' => 'De indtastede kodeord er ikke ens',
        ];

        $validator = Validator::make($request->input(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("controlpanelSettingsPassword")
                        ->withErrors($validator)->withInput();
        }


        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route("controlpanelSettings")->with('success', 'Kodeord blev ændret!');


    }


    public function registerPage() {
        $view = view("pages.register");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function register(Request $request) {
        $rules = [
             'username' => ['required', 'unique:users'],  
             'email' => ['required', 'email', 'unique:users'], 
             'password' => ['required', 'same:password-check'], 
             'password-check' => ['required']
        ];

        $messages = [
            'username.unique' => 'Dette brugernavn er allerede taget',
            'email.unique' => 'Denne email er allerede i brug',
            'required' => 'Feltet er påkrævet.',
            'password-check.required' => 'Du skal gentage dit nye kodeord.',
            'password.same' => 'De indtastede kodeord er ikke ens',
        ];

        $validator = Validator::make($request->input(), $rules, $messages);

        // Validate and redirect if fails
        if ($validator->fails()) {
            return redirect()->route("register")
                        ->withErrors($validator)->withInput();
        }

        $client = new Client;
        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip()
                ]
        ]);

        $isValidated = json_decode($response->getBody())->success;


        if(!$isValidated) {
            return redirect()->route("register")
                        ->with("error", "Du skal bevise du er et menneske.")->withInput();
        }    

        // Create user
        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->activationToken = str_random(20);
        $user->role = 2;

        $user->save();

        // Send confirm mail
        Mail::to($user->email)->send(new ActivateAccount($user->activationToken));

        return redirect()->route('home')->with('status-message', 'Tak for din tilmelding! Vi mangler nu bare at bekræfte din email!');
    }


    public function activateAccount(Request $request, $token) {
        $user = User::where('activationToken', $token)->first();

        if(!$user) { // Failed to find activation token
            return redirect()->route("home")
                        ->with("error", "Token var ugyldig, prøv igen. Hvis dette problem fortsat opstår, skal du kontakte os.");
        }

        // Activate user
        $user->active = 1;
        $user->save();

        // Send welcome mail
        Mail::to($user->email)->send(new Welcome());

        return redirect()->route('home')->with('status-message', 'E-mail blev bekræftet!');
    }


    public function forgotpasswordPage(Request $request) {
        $view = view("pages.forgotpassword");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function sendResetPasswordMail(Request $request) {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return redirect()->route("forgotpassword")
                        ->with("error", "E-mail'en eksisterer ikke hos os.");
        }

        $user->resetPasswordToken = str_random(20);
        $user->resetTokenSent = Carbon::now();
        $user->save();


        Mail::to($request->email)->send(new ResetPasswordMail($user->resetPasswordToken));

        return redirect()->route("home")
                        ->with("status-message", "Nulstillings mail er sendt!");
    }


    public function resetPasswordPage(Request $request, $token) {
        $user = User::where('resetPasswordToken', $token)->first();

        if(!$user) {
            return redirect()->route("home")
                        ->with("status-error", "Ups! Dit nulstillings link, virker ikke. Prøv at anmode om en nulstilling igen.");
        }

        if($user->resetTokenSent >= strtotime("-12 hours")) {
            return redirect()->route("home")
                        ->with("status-error", "Ups! Dit nulstillings link, Udløbet. Prøv at anmode om en nulstilling igen.");
        }

        $view = view("pages.resetpassword");

        $view->token = $token;
        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function resetPassword(Request $request, $token) {
        $rules = [
             'password' => ['required', 'same:password-check'], 
             'password-check' => ['required'],
        ];

        $messages = [
            'password.required' => 'Feltet er påkrævet.',
            'password-check.required' => 'Du skal gentage dit nye kodeord.',
            'password.same' => 'De indtastede kodeord er ikke ens',
        ];

        $validator = Validator::make($request->input(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("resetpassword")
                        ->withErrors($validator)->withInput();
        }


        $user = User::where('resetPasswordToken', $token)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route("home")->with('success', 'Kodeord blev ændret!');


    }


    public function buyPremiumHandle(Request $request) {
        $user = User::find(Auth::user()->id);   

        //dd($request);

        $creditCardToken = $request->stripeToken;
        $email = $request->email;

        if (!$user->subscribed('main')) {
            $subscription = $user->newSubscription('premium', 'premium')->create($creditCardToken, [
                'email' => $email,
            ]);

            $invoice = $user->invoices()->last();

            // Send welcome mail
            Mail::to($user->email)->send(new ThanksForBuying($invoice));

            return redirect(route('home').'/thankyou');
        } else {
            return redirect()->route("controlpanel")->with('error', 'Du abonnerer allerede.');
        } 
    }

    public function cancelSubscription(Request $request) {
        $user = User::find(Auth::user()->id);   

        $user->subscription('premium')->cancel();

        return redirect()->route("controlpanel")->with('success', 'Abonnement afsluttet');
    }

    public function updateCardPage(Request $request) {
        $view = view("pages.controlpanel.settings.updatecard");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function updateCard(Request $request) {
        $user = User::find(Auth::user()->id);   

        $creditCardToken = $request->stripeToken;
        $user->updateCard($creditCardToken);

        return redirect()->route("controlpanelSettings")->with('success', 'Kortoplysninger opdateret!');
    }

    public function invoicesPage(Request $request) {
        $view = view("pages.controlpanel.settings.invoices");

        $view->currentPath = Route::getCurrentRoute()->uri();

        return $view;
    }

    public function generateApiKey(Request $request) {
        $user = User::find(Auth::user()->id);

        $user->apitoken = str_random(35);
        $user->save();

        return redirect()->route("controlpanelSettings")->with('success', 'Apikey opdateret!');
    }

    public function apiLogin(Request $request) {
        $username = $request->get('username');
        $password = base64_decode($request->get('password'));

        if (Auth::once(['username' => $username, 'password' => $password])) {
            $result = [
                'status' => 1,
                'message' => 'success',
                'apitoken' => Auth::user()->apitoken,
            ];

            return json_encode($result);
        } else {
            $result = [
                'status' => 0,
                'message' => 'username or password was incorrect',
            ];

            return json_encode($result);
        }


    }

    public function apiUser(Request $request) {
        $apitoken = $request->get('token');

        $user = User::where('apitoken', $apitoken)->first();

        $result = [
            'status' => 1,
            'message' => 'success',
            'username' => $user->username,
            'email' =>  $user->email,
            'role' => $user->role,
        ];


        return json_encode($result);
    }
}
