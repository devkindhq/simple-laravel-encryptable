<?php

/**
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Encryption cipher
    |--------------------------------------------------------------------------
    |
    | The cipher used to encrypt data.
    | Once defined, never change it or encrypted data cannot be correctly decrypted.
    | Default value is the cipher algorithm used by default in MySQL.
    |
    */
    'key' => env('ENCRYPTION_KEY', env('APP_KEY')),

    /*
    |--------------------------------------------------------------------------
    | Encryption cipher
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */
    'cipher' => env('ENCRYPTION_CIPHER', config('app.cipher', 'AES-256-CBC')),

    /*
    |--------------------------------------------------------------------------
    | Encryption cipher
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service
    | An initialization vector (IV) is an arbitrary number
    | that can be used with a secret key for data encryption to foil cyber attacks.
    |
    */
    'cipher_iv' => env('ENCRYPTION_IV'),

    /*
    |--------------------------------------------------------------------------
    | Encryption cipher
    |--------------------------------------------------------------------------
    |
    | This key is used by the prefix the encrypted value into Database
    |
    */
    'prefix' => env('ENCRYPTION_PREFIX', 'XXX'),

];