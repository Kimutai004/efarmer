<?php

return [
    'consumer_key' => env('KCB_BUNI_CONSUMER_KEY'),
    'consumer_secret' => env('KCB_BUNI_CONSUMER_SECRET'),
    'base_url' => env('KCB_BUNI_BASE_URL', 'https://uat.buni.kcbgroup.com'),
    'account_reference' => env('KCB_ACCOUNT_REFERENCE'),
    'callback_url' => env('KCB_BUNI_CALLBACK_URL', 'http://localhost:8000/api/mpesa/callback'),
    'route_code' => env('KCB_BUNI_ROUTE_CODE', '207'),
    'operation' => env('KCB_BUNI_OPERATION', 'STKPush'),
    'org_shortcode' => env('KCB_BUNI_ORG_SHORTCODE', ''),
    'org_passkey' => env('KCB_BUNI_ORG_PASSKEY', ''),
    'transport_fee_per_goat' => env('TRANSPORT_FEE_PER_GOAT', 300),
];