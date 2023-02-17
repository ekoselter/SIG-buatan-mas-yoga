<?php

use App\Http\Controllers\CategoryChildController;
use App\Http\Controllers\CategoryChildrenController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardMapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RegisterController;
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
//route landing page
Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home',
    ]);
});

//route login dan logout
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//route register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//route untuk masuk kehalaman dashboard
Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

//route untuk masuk kehalaman home
Route::get('/home', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home',
    ]);
});

//route untuk masuk kehalaman about
Route::get('/about', function () {
    return view('about2', [
        "title" => "About",
        "active" => 'about',
    ]);
});

Route::get('/peta', function () {
    return view('maps.main', [
        "title" => "Peta",
        "active" => 'peta',
    ]);
});

//route untuk masuk kehalaman map
Route::get('/peta', [MapController::class, 'index']);
Route::get('/peta/{map:}', [MapController::class, 'index']);

//pendefinisian route dengan tipe resource
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');
Route::resource('/dashboard/categoryChildren', CategoryChildrenController::class)->middleware('auth');
Route::resource('/dashboard/maps', DashboardMapController::class)->middleware('auth');

