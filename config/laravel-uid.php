<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Customize how the uid is created and used
    |--------------------------------------------------------------------------
    */
    'characters' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'prefix_separator' => '_',
    'length' => 16,
    // Used with the Models Trait
    'uid_column' => 'uid',
    'check' => true,
];