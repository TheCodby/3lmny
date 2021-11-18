<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Material;

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

Route::get('/', function () {
    return view('index', ['VisitorsCount' => Visitor::all()->count(), 'UsersCount' => User::all()->count(), 'MaterialsCount' => Material::all()->count()]);
})->name('index');
Route::get('/SetLangauage/{locale}', function ($locale) {
	if (isset($locale) && array_key_exists($locale, config('app.locales'))) {
		session()->put('locale', $locale);
		return redirect()->back();
    }
	return redirect()->back();
})->name('lang');
Route::middleware(['guest'])->group(function () {
	Route::prefix('Auth')->group(function () {
		Route::get('/Register', [RegisterController::class, 'show'])->name('register');
		Route::post('/Register', [RegisterController::class, 'create'])->name('register');
		Route::get('/Login', [LoginController::class, 'show'])->name('login');
		Route::post('/Login', [LoginController::class, 'check'])->name('login');
	});
});
Route::middleware(['auth'])->group(function () {
	Route::get('/Bookmarks', [MaterialsController::class, 'bookmarks'])->name('materials.bookmarks');
	Route::prefix('Profile')->group(function () {
		Route::get('', ProfileController::class)->name('myprofile');
		Route::get('Edit', [ProfileController::class, 'showEditProfile'])->name('profile.edit');
		Route::post('Edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
		Route::get('/{id}', [ProfileController::class, 'showProfile'])->name('profile');
	});
	Route::prefix('Auth')->group(function () {
		Route::get('/Logout', LogoutController::class)->name('logout');
	});
});
Route::prefix('Materials')->group(function () {
	Route::get('/', MaterialsController::class)->name('materials');
	Route::get('/Fetch', [MaterialsController::class, 'getMaterialsByPage']);
	Route::get('/Filter', [MaterialsController::class, 'filterMaterials']);
	Route::get('/{id}', [MaterialsController::class, 'showMaterial'])->name('materials.show');
	Route::middleware(['auth'])->group(function () {
		Route::post('/{id}/Bookmark', [MaterialsController::class, 'bookmarkMaterial'])->name('materials.bookmark');
		Route::post('/{id}/Rate', [MaterialsController::class, 'rateMaterial'])->name('materials.rate');
		Route::post('/{id}/AddComment', [MaterialsController::class, 'addComment'])->name('materials.commend.add');
		Route::get('/{id}/DeleteComment/{commentID}', [MaterialsController::class, 'deleteComment'])->name('materials.commend.delete');
	});
});
