<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;


if(!function_exists('url_info')){
    function url_info(){
        return URL::current();
        // return Route::current()->getName();
    }
}
