<?php

namespace App\Providers;

use App\Passport\Passport;
use Illuminate\Support\ServiceProvider;
//use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Cashier::useCurrency('dkk', 'DKK');

        Cashier::formatCurrencyUsing(function($amount) {
            $amount = number_format($amount / 100, 2);
            return $amount.Cashier::usesCurrencySymbol();
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
