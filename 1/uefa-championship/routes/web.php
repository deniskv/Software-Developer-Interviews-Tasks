<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/{any}', function () {
    return view('home');
})->where('any', '^(?!api).*$');
