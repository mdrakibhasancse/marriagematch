<?php

// SSLCommerz configuration

$apiDomain = env('SSLCZ_TESTMODE') ? "https://sandbox.sslcommerz.com" : "https://securepay.sslcommerz.com";


return [
    'apiCredentials' => [
        'store_id' => env('SSLCZ_TESTMODE') ? env('SSLCZ_STORE_ID_TEST') : env('SSLCZ_STORE_ID_LIVE'),
        'store_password' => env('SSLCZ_TESTMODE') ? env('SSLCZ_STORE_PASSWORD_TEST') : env('SSLCZ_STORE_PASSWORD_LIVE'),

    ],


    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'apiDomain' => $apiDomain,
    'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
    'success_url' => '/success',
    'failed_url' => '/fail',
    'cancel_url' => '/cancel',
    'ipn_url' => '/ipn',
];
