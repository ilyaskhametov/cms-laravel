<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'pages');

Route::resources([
    'media_files' => 'MediaFileController',
    'pages' => 'PageController',
]);
