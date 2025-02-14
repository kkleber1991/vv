<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root namespace for Livewire component classes in
    | your application. This value affects component auto-discovery.
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value sets the path for Livewire component views. This affects
    | file manipulation helper commands like `artisan make:livewire`.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | The layout that should be used for full-page Livewire components.
    |
    */

    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Configure the file upload temporary storage mechanism.
    |
    */

    'temporary_file_upload' => [
        'disk' => 'local',
        'rules' => [
            'max:50000', // Limite de 50MB
            'mimes:jpg,jpeg,png,gif,mp4,avi,mov' // Tipos de arquivo permitidos
        ],
        'directory' => 'livewire-tmp',
        'middleware' => 'throttle:5,1',
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'jpg', 'jpeg', 
            'wav', 'mp4', 'mov', 'avi', 'webm'
        ],
        'max_upload_time' => 5,
    ],

    /*
    |--------------------------------------------------------------------------
    | Manifest File
    |--------------------------------------------------------------------------
    |
    | The manifest file path where Livewire's JavaScript manifest is stored.
    |
    */

    'manifest_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Back Button Cache
    |--------------------------------------------------------------------------
    |
    | Configure the back button cache behavior.
    |
    */

    'back_button_cache' => false,

    /*
    |--------------------------------------------------------------------------
    | Render On Request
    |--------------------------------------------------------------------------
    |
    | If true, Livewire will render components on each request.
    |
    */

    'render_on_request' => false,
]; 