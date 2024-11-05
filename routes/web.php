<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Models\Accessories;
use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\NickController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/layout', function () {
    return view('layout');
});
Route::get('/',[IndexController::class,'home'] );
Route::get('/dich-vu ',[IndexController::class,'dichvu'])->name('dichvu');//dịch vụ tổng
Route::get('/dich-vu/{slug} ',[IndexController::class,'dichvucon'])->name('dichvucon');//dịch vụ con thuộc dịch vụ
Route::get('/danh-muc-game/{slug}',[IndexController::class,'danhmuc_game'])->name('danhmucgame');//danh mục tổng
Route::get('/accgame/{slug} ',[IndexController::class,'acc'])->name('danhmuccon');//danh mục con thuộc danh mục
route::resource('/category',CategoryController::class);
route::resource('/slider',SliderController::class);
route::resource('/accessories',AccessoriesController::class);
route::resource('/nick',NickController::class);
Route::post('/choose_category', [NickController::class, 'choose_category'])->name('choose_category');
require __DIR__.'/auth.php';
