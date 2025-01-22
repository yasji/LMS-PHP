<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BorrowRecordController;
use App\Http\Controllers\Api\FineController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\LoanController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Books
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{book}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store'])->middleware('can:manage-books');
    Route::patch('/books/{book}', [BookController::class, 'update'])->middleware('can:manage-books');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware('can:delete-books');
    Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->middleware('can:borrow-books');
    Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->middleware('can:return-books');

    // Authors
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author}', [AuthorController::class, 'show']);
    Route::post('/authors', [AuthorController::class, 'store'])->middleware('can:manage-authors');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])->middleware('can:manage-authors');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->middleware('can:delete-authors');

    // Categories
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::post('/categories', [CategoriesController::class, 'store'])->middleware('can:manage-categories');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->middleware('can:delete-categories');


    // Users
    Route::get('/users', [UserController::class, 'index'])->middleware('can:view-users');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware('can:view-users');
    Route::get('/userinfo', [UserController::class, 'me']);
    Route::post('/users', [UserController::class, 'store'])->middleware('can:manage-users');
    Route::patch('/users/{user}', [UserController::class, 'update'])->middleware('can:manage-users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('can:delete-users');


    // Loans
    Route::get('/loans', [LoanController::class, 'index'])->middleware('can:view-loans');
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->middleware('can:delete-loans');
    Route::get('loans/overdue', [LoanController::class, 'checkOverdue'])->middleware('can:manage-loans');
    Route::get('loans/overdue/{loan}', [LoanController::class, 'show']);


});