<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-cache', function() {
    // Cache::put('key', 'value');
    // Cache::put('key-1', 'value-1', 30); //seconds
    // Cache::put('key-2', 'value-2', now()->addMinutes(10)); //seconds
    // Cache::store('file')->put('key-3', 'value-3');
    // Cache::set('key-4', 'value-4');
});
