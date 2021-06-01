<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Tahunajaran;

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
    return view('auth.login');
})->name('welcome');

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum'])->post('/addMaster', [MasterController::class, 'add'] )->name('addMaster');
// Tahun Ajaran
Route::middleware(['auth:sanctum'])->get('/tahun-ajaran', [MasterController::class, 'tahun'] )->name('tahunajaran');
// Dosen
Route::middleware(['auth:sanctum'])->get('/dosen', [MasterController::class, 'dosen'] )->name('dosen');
Route::middleware(['auth:sanctum'])->post('/dosen-import', [MasterController::class, 'import'] )->name('dosen.import');
// Koordinator
Route::middleware(['auth:sanctum'])->get('/koorkp', [MasterController::class, 'koorkp'] )->name('koorkp');
Route::middleware(['auth:sanctum'])->get('/koorta', [MasterController::class, 'koorta'] )->name('koortah');
