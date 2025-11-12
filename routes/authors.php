<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;


Route::resource('author', AuthorController::class)->middleware(['auth', 'verified']);