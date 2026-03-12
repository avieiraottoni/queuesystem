<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    
    echo config('app.name');

});
