<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Subscription;
use App\User;

use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeController extends CashierController {

    /**
     * [description]
     * @param  array  $payload [description]
     * @return [type]          [description]
     */
    
    public function handleCustomerSubscriptionUpdated(array $payload)
    {
        print_r($payload);
        return new Response('Webhook Not handled', 500);
    }

    /**
     * Customer subscription ended! Set user role to lower id
     * @param  array  $payload [description]
     * @return [type]          [description]
     */
    public function handleCustomerSubscriptionDeleted(array $payload)
    {
    	// Get subscription id
        $stripe_id = $payload['data']['object']['id'];

        // Get the subscription
        $subscription = Subscription::where('stripe_id', $stripe_id)->first();
        
        if($subscription) {
        	// Change user role back to normal user
        	$user_id = $subscription->user_id;
        	$user = User::find($user_id);
        	$user->role = 2;
        	$user->save();

        	// Delete subscription from our system
        	$subscription->delete();

        	return new Response('Webhook handled', 200);
        } else {
        	return new Response('Webhook not handled, subscription not found', 500);
        }        
    }


    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  array   $parameters
     * @return mixed
     */
    public function missingMethod($parameters = [])
    {
        return new Response('Missing webhook', 500);
    }
}
