<?php

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

// список всех компаний
Route::get('/', [App\Http\Controllers\CompanyController::class, 'allCompany'])->name('all-company');
Route::post('/get-village-by-district', [App\Http\Controllers\VillageController::class, 'getVillageByDistrict'])->name('get-village-by-district');

// роутер страницы "важной информации"
Route::get('/information', function() {
   return view('information');
})->name('information');

// роутеры для авторизации, регистрации
\Illuminate\Support\Facades\Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// роутер страницы из API
Route::get('/api', function() {
   return view('api');
})->middleware('auth')->name('api');

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
   Route::resource('/company', 'App\Http\Controllers\Admin\CompanyController');
});