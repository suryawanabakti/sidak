<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/admin/login');
Route::redirect('/pimpinan/login', '/admin/login')->name('login');
