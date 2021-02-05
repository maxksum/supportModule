<?php

return [
    /*
     * Login route
     */
    'login_route' => env('STEAM_LOGIN', '/user/login'),

    /*
     * Return route
     */
    'return_route' => env('STEAM_RETURN', '/user/auth/steam'),

    /*
     * Timeout when validating
     */
    'timeout' => env('STEAM_TIMEOUT', 5),

    /*
     * Method of retrieving user's info
     */
    'method' => env('STEAM_PROFILE_METHOD', 'xml'),

    /*
     * API key (http://steamcommunity.com/dev/apikey)
     */
    'api_key' => env('STEAM_API_KEY', '92A6C8F2C27DF8250D1D8F2ACFD93381'),
];
