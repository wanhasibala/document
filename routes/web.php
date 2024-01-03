<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin', 'verified')->group(function(){
    Route::get('/dashboard/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/dashboard/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/dashboard/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/dashboard/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/dashboard/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.update');
});

require __DIR__.'/auth.php';
