<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookContr;
use App\Http\Controllers\CategoryContr;

Route::get('/', function () {
    return view('index');
});

// LIBROS
Route::get('/books', [BookContr::class,'index']);
Route::post('/books', [BookContr::class,'store']);

// CATEGORIAS
Route::get('/categories', [CategoryContr::class,'index']);
Route::post('/categories', [CategoryContr::class,'store']);