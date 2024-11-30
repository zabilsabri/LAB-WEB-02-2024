<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('master');
})->name('master');; 

Route::get('/home', function () {
    return view('home');
})->name('home');;

Route::get('/about', function () {
    return view('about');
})->name('');;

Route::get('/contact', function () {
    return view('contact');
})->name('contact');;
