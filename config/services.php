<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Models\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1574039372894481',
        'client_secret' => 'cd9bb72c44d8024917431f877ab5297f',
        'redirect' => 'http://cars2.kz/socialite/success_facebook_auth',
    ],

    'vkontakte' => [
        'client_id' => '5445048',
        'client_secret' => 'R2lTaC0S0EaZE0hqnDXW',
        'redirect' => 'http://cars2.kz/socialite/success_vkontakte_auth',
    ],

];
