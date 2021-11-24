<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;


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
Route::prefix('Materials')->group(function () {
    Route::post('Add', [AdminController::class, 'AddMaterial'])->name('admin.materials.add');
    Route::post('Search', [AdminController::class, 'SearchMaterial'])->name('admin.materials.search');
    Route::get('Edit/{id}', [AdminController::class, 'showEditMaterial'])->name('admin.materials.edit');
    Route::post('Edit/{id}', [AdminController::class, 'EditMaterial'])->name('admin.materials.edit');
    Route::get('Delete/{id}', [AdminController::class, 'DeleteMaterial'])->name('admin.materials.delete');
    Route::get('Fetch', [AdminController::class, 'getMaterialsPerPage']);
	Route::get('Filter', [AdminController::class, 'filterMaterials']);
    Route::get('Requests', [AdminController::class, 'showRequests']);
    Route::get('Request/{id}', [AdminController::class, 'showMaterialRequest'])->name('material.request');
    Route::get('Request/Delete/{id}', [AdminController::class, 'DeleteMaterialRequest'])->name('material.request.delete');
    Route::post('Request/Publish/{id}', [AdminController::class, 'PublishMaterialRequest'])->name('material.request.publish');
});
Route::prefix('Contacts')->group(function () {
    Route::get('Fetch', [AdminController::class, 'getMessagesPerPage']);
    Route::post('{id}/Read', [ContactController::class, 'read']);
});
Route::prefix('Users')->group(function () {
    Route::get('Fetch', [AdminController::class, 'getUsersPerPage']);
    Route::get('Filter', [AdminController::class, 'filterUser']);
    Route::get('{id}', [AdminController::class, 'showUser']);
});
Route::prefix('Types')->group(function () {
    Route::post('Add', [AdminController::class, 'AddType'])->name('admin.types.add');
    Route::get('Delete/{id}', [AdminController::class, 'DeleteType'])->name('admin.types.delete');
});
Route::prefix('Levels')->group(function () {
    Route::post('Add', [AdminController::class, 'AddLevel'])->name('admin.levels.add');
    Route::get('Delete/{id}', [AdminController::class, 'DeleteLevel'])->name('admin.levels.delete');
});