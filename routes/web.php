<?php

use Illuminate\Support\Facades\Route;

Route::get('/viewdata', function () {
    return view('AjaxApi.viewdata');
});
