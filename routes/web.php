<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    if (auth()->check()) {
        return view('dashboard');
    } else {
        return redirect('/login');
    }
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    // Keep Breeze login (or replace it too if needed)
});

// Use Breeze for login (it's simpler)
require __DIR__.'/auth.php';

// Language switch (works everywhere)
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');

    // Group-scoped expense creation
    Route::get('/groups/{group}/expenses/create', [ExpenseController::class, 'create'])
      ->name('expenses.create');

    Route::post('/groups/{group}/expenses', [ExpenseController::class, 'store'])
      ->name('expenses.store');

    // Add member to group
    Route::post('/groups/{group}/members', [GroupController::class, 'addMember'])->name('groups.add-member');

    // Other expense actions (not group-scoped)
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

    Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

});