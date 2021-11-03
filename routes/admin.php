<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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

Route::get('/', AdminController::class)->name('admin');
Route::post('/Materials/Add', [AdminController::class, 'AddMaterial'])->name('admin.materials.add');
Route::post('/Materials/Search', [AdminController::class, 'SearchMaterial'])->name('admin.materials.search');
Route::get('/Materials/Edit/{id}', [AdminController::class, 'EditMaterial'])->name('admin.materials.edit');
Route::get('/Materials/Delete/{id}', [AdminController::class, 'DeleteMaterial'])->name('admin.materials.delete');
Route::post('/Types/Add', [AdminController::class, 'AddType'])->name('admin.types.add');
Route::get('/Types/Delete/{id}', [AdminController::class, 'DeleteType'])->name('admin.types.delete');