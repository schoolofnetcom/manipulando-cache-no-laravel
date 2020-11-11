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

Route::get('check-key', function(){
    Cache::put('increment', 1);
    if(Cache::has('increment')) {
        Cache::increment('increment', 19);
    }
    echo Cache::get('increment');

    echo "<hr>";

    Cache::put('decrement', 20);
    if(Cache::has('decrement')) {
        Cache::decrement('decrement', 10);
    }
    echo Cache::get('decrement');
});

Route::get('remember', function(){
    // $users = Cache::get('users', function(){
    //     return DB::table('users')->get('id');
    // });

    // var_dump($users);

    // echo "<hr>";

    // var_dump(Cache::has('users'));

    Cache::remember('users', 20, function(){
        return DB::table('users')->get('id');
    });

    var_dump(Cache::get('users'));

    Cache::rememberForever('users-forever', function(){
        return DB::table('users')->get('id');
    });

    echo "<hr>";

    var_dump(Cache::get('users-forever'));
});

Route::get('remove-cache', function(){
    // Cache::put('pull', 'pull-value');
    // $pull = Cache::pull('pull');
    // var_dump($pull, Cache::get('pull'));

    // Cache::put('forget', 'forget-values');
    // var_dump(Cache::get('forget'));
    // echo "<hr>";
    // Cache::forget('forget');
    // var_dump(Cache::get('forget'));

    Cache::put('key', "value");
    Cache::put('key1', "value");
    Cache::put('key2', "value");
    Cache::put('key3', "value");

    var_dump(Cache::get('key'), Cache::get('key2'), Cache::get('key3'), Cache::get('key1'));

    // Cache::flush();
    echo "<hr>";
    Cache::store('file')->flush();

    var_dump(Cache::get('key'), Cache::get('key2'), Cache::get('key3'), Cache::get('key1'));

});


Route::get('helper-cache', function(){
    cache()->put('key', 'value of key');
    var_dump(cache()->get('key'));

    echo "<hr>";

    cache(["key-1" => "value-1"], 20);
    cache(["key-2" => "value-2"], now()->addMinutes(5));
    var_dump(cache()->get('key-1'), cache()->get('key-2'));

    echo "<hr>";


    cache()->remember('my-key', now()->addMinutes(5), function(){
        return "my key default value";
    });
    var_dump(cache()->get('my-key'));
});

Route::get('events', function(){
    cache()->put('first-cache', 'first-value');
    // cache()->put('second-cache', 'second-value', 20);
    cache()->forget('first-cache');
    echo cache()->get('second-cache');
});
