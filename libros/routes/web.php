<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/books', [BookController::class,'index']);
Route::post('/books', [BookController::class,'store']);

Route::get('/categories', [BookController::class,'categories']);
Route::post('/categories', [CategoryController::class,'store']);