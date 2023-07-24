<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('employees', App\Http\Controllers\EmployeeController::class);
Route::resource('tasks', App\Http\Controllers\TaskController::class);
Route::put('tasks/{task}', [App\Http\Controllers\TaskController::class, 'assign'])->name('tasks.assign');
//as
Route::post('tasks/{task}/start', [App\Http\Controllers\TaskController::class, 'start'])->name('tasks.start');
Route::post('tasks/{task}/done', [App\Http\Controllers\TaskController::class, 'done'])->name('tasks.done');
Route::get('tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');

Route::post('tasks/{task}', [App\Http\Controllers\TaskController::class, 'changeAssignee'])->name('tasks.changeAssignee');