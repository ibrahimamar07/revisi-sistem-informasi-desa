<?php

return [

    'defaults' => [
    'guard' => 'web', // default (boleh untuk web A)
    'passwords' => 'users',
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users', // Guard default → untuk table users
    ],

    'pengguna' => [
        'driver' => 'session',
        'provider' => 'pengguna', // Guard tambahan → untuk table pengguna
    ],
],
 
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class, // Untuk table 'users'
    ],

    'pengguna' => [
        'driver' => 'eloquent',
        'model' => App\Models\Pengguna::class, // Untuk table 'pengguna'
    ],
],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pengguna' => [
            'provider' => 'pengguna',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];