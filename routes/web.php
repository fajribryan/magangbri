<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\InventarisController;

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
    return view('login/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');


Route::get('/akunuser', [AkunController::class, 'index']);
Route::get('/akunuser/destroy/{id}', [AkunController::class, 'destroy']);
Route::get('/akunuser/edit/{id}', [AkunController::class, 'edit']);
Route::put('/update/{id}', [AkunController::class, 'update']);


Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris');
Route::get('/inventaris/create', [InventarisController::class, 'create']);
Route::post('/inventaris/input', [InventarisController::class, 'input'])->name('inventaris.input'); 
Route::get('/inventaris/destroy/{id}', [InventarisController::class, 'destroy']);
Route::get('/inventaris/edit/{id}', [InventarisController::class, 'edit']);
Route::put('/inventaris/update/{id}', [InventarisController::class, 'update']);

