<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

Route::get('/all/category', [CategoryController::class, 'index'])->name('AllCat');


Route::post('/create/category', [CategoryController::class, 'store'])->name('categories.store');
;
Route::get('/all/category/delete/{id}', [CategoryController::class, 'Delete'])->name('delete.category');
Route::get('/all/category/forceDelete/{id}', [CategoryController::class, 'ForceDelete'])->name('forceDelete.category');
Route::get('/all/editCategory/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/all/editCategory/update/{id}', [CategoryController::class, 'Update'])->name('update.category');
Route::get('/all/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');


