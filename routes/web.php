<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


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

Route::get('/todoravel', function () {
    return view('todoravel');
})->middleware(['auth', 'verified'])->name('todoravel');


Route::get('/tasks/index.blade.php', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::delete('/tasks/index.blade.php/{id}', [TaskController::class, 'delete'])->name('tasks.delete');

Route::delete('/tasks/task/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::post('/tasks/task/{id}', [TaskController::class, 'onoff'])->name('tasks.onoff');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






require __DIR__ . '/auth.php';
