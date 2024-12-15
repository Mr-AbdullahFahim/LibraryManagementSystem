<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard',[Dashboard::class, 'index'])->name('dashboard');
    Route::get('/members',[MembersController::class,'index'])->name('members');
    Route::post('/members/store',[MembersController::class,'store'])->name('members.store');
    Route::get('/books',[BooksController::class,'index'])->name('books');
    Route::post('/books/store',[BooksController::class,'store'])->name('books.store');
    Route::get('/subscriptions',[SubscriptionController::class,'index'])->name('subscription');
    Route::post('/subscriptions/update',[SubscriptionController::class,'update'])->name('subscription.update');
    Route::get('/members/{id}/edit', [MembersController::class, 'editMember'])->name('members.edit');
    Route::post('/members/{id}/update', [MembersController::class, 'updateMember'])->name('members.update');
    Route::delete('/members/{id}', [MembersController::class, 'destroy'])->name('members.destroy');
    Route::get('/books/{id}/edit', [BooksController::class, 'edit'])->name('books.edit');
    Route::post('/books/{id}/update', [BooksController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BooksController::class, 'destroy'])->name('books.destroy');
    Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
    Route::post('/checkout/returned', [CheckoutController::class, 'returned'])->name('checkout.returned');
});

require __DIR__.'/auth.php';
