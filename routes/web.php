<?php

use App\Http\Controllers\Admin\ItemModerationController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'items' => Item::with('user')->where('is_verified', true)->latest()->take(6)->get(),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('items.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/listings', function () {
    return view('items.public-index', [
        'items' => Item::with('user')->where('is_verified', true)->latest()->paginate(12),
    ]);
})->name('items.public');

Route::middleware('auth')->group(function () {
    Route::resource('items', ItemController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/items', [ItemModerationController::class, 'index'])->name('items.index');
    Route::patch('/items/{item}', [ItemModerationController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemModerationController::class, 'destroy'])->name('items.destroy');
});

require __DIR__.'/auth.php';
