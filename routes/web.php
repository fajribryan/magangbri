<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\SurveyController;

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
Route::get('/ro/detail/{namau}', [dashboardController::class, 'ro'])->middleware('auth');
Route::get('/kc/detail/{namau}', [dashboardController::class, 'kc'])->middleware('auth');
Route::get('/exportpremiseskc/{kc}', [DashboardController::class, 'exportCsv'])->name('export.premiskc');


Route::get('/premisslm', [AkunController::class, 'index'])->middleware('auth');
Route::get('/exportslm', [AkunController::class, 'exportslm'])->middleware('auth');
Route::post('/exportexcellslm', [AkunController::class, 'exportexcellslm'])->middleware('auth');


Route::resource('inventaris', InventarisController::class)->middleware('auth');
Route::get('/nonslm/ro/{namau}', [InventarisController::class, 'ro'])->middleware('auth');
Route::get('/inventarisexcel', [InventarisController::class, 'inventarisexcel'])->middleware('auth');
Route::post('importexcel', [\App\Http\Controllers\InventarisController::class, 'importexcel'])->name('import.excel')->middleware('auth');
// Tambahkan di dalam file web.php
Route::get('/exportpremisesro/{ro}', [InventarisController::class, 'exportpremises'])->name('export.premisro')->middleware('auth');


Route::resource('survey', SurveyController::class)->middleware('auth');

Route::get('/surveyadd', function () {
    return view('admin/survey/surveyadd', [
        'title' => 'Create survey',
        'active' => 'Create survey',
    ]);
})->middleware('auth');

Route::get('/surveyonsite', [SurveyController::class, 'surveyonsite'])->middleware('auth');
Route::post('/jenislokasi', [SurveyController::class, 'jenislokasi'])->middleware('auth');






// Route::get('/inventaris/add', function () {
//     return view('admin/inventaris/buatinventaris');
// });

// Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris');
// Route::post('/inventaris/input', [InventarisController::class, 'input'])->name('inventaris.input'); 
// Route::get('/inventaris/destroy/{id}', [InventarisController::class, 'destroy']);
// Route::get('/inventaris/edit/{id}', [InventarisController::class, 'edit']);
// Route::put('/inventaris/update/{id}', [InventarisController::class, 'update']);

