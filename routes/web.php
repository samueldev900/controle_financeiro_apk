<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(config('app.timezone'));
});
