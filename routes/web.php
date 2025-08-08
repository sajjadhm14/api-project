<?php

use App\Http\Controllers\DigikalaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('digikala-book', [DigikalaController::class , 'getBooksFromDigikala']);
