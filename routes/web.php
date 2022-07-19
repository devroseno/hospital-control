<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PacienteController::class, 'index']);
Route::post('/store', [PacienteController::class, 'store'])->name('store');
Route::get('/fetchall', [PacienteController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [PacienteController::class, 'delete'])->name('delete');
Route::get('/edit', [PacienteController::class, 'edit'])->name('edit');
Route::post('/update', [PacienteController::class, 'update'])->name('update');
