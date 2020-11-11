<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-cache', function() {
    Cache::put('key-array', ['value-1', 'value-2', 'value-3']);
    Cache::put('key-1', 'value-1', 10); //seconds
    Cache::put('key-2', 'value-2', now()->addMinutes(10)); //seconds
    Cache::store('file')->put('key-3', 'value-3');
    Cache::set('key-4', 'value-4');
});

Route::get('/get-cache', function() {
    var_dump(Cache::get('key-array'));
    echo "<br>";
    echo Cache::get('key-1') . "<br>";
    echo Cache::get('key-2') . "<br>";
    echo Cache::store('file')->get('key-3') . "<br>";
    echo Cache::get('key-4') . "<br>";
    echo Cache::get('nao_existe', 'Meu valor padrão') . "<br>";
    $users = Cache::get('users', function(){
        return DB::table('users')->get('id');
    }) . "<br>";
    var_dump($users);
});
