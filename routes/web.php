<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\search;

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
    $user = Auth::user();
    $documents = $user->documents()->orderBy("created_at", 'desc')->limit(1)->get();
    return view('dashboard', compact('documents'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('document', DocumentController::class);
    Route::get('/dashboard/trash', [DocumentController::class, 'trash'])->name('document.trash');
    Route::put('/document/restore/{id}', [DocumentController::class, 'restore'])->name('document.restore');
    Route::post('/document/search', [DocumentController::class, 'search'])->name('document.search');
    Route::delete('/document/{id}/permanentdelete',[DocumentController::class, 'permanentDelete'])->name('document.permanentDelete');
    Route::post('tags', [DocumentController::class, 'getTags'])->name('get-tags');
    // Route::post('/document', [DocumentController::class, 'store'])->name('document.store');
    // Route::get('/document/{id}', [DocumentController::class, 'show'])->name('document.show');
    // Route::get('/document/{id}/edit', [DocumentController::class, 'edit'])->name('document.edit');
    // Route::delete('/document/{id}', [DocumentController::class, 'destroy'])->name('document.destroy');
});

Route::middleware('admin', 'verified')->group(function(){
    Route::get('/dashboard/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/dashboard/admin/users', [AdminController::class, 'user'])->name('admin.users');
    Route::get('/dashboard/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('/dashboard/admin/{user}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('/dashboard/admin/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/dashboard/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/dashboard/admin', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/dashboard/admin/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/dashboard/admin/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/dashboard/admin/{category}/edit', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/userexport', [AdminController::class, 'userexport'])->name('userexport');
    Route::post('/userimport', [AdminController::class, 'userimport'])->name('userimport');

});

require __DIR__.'/auth.php';
