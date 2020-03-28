<?php

use Illuminate\Support\Facades\Route;

Route::resources([
    'media_files' => 'MediaFileController',
    'pages' => 'PageController',
]);
