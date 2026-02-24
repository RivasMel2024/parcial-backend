<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnLoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('v1/books', [BookController::class, 'index']);
Route::post('v1/loans', [LoanController::class, 'store']);
Route::post('v1/loans/{loan}/return', ReturnLoanController::class);
Route::get('v1/loans', [LoanController::class, 'index']);