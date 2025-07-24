<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::resource('surat-izin', App\Http\Controllers\SuratIzinController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/surat/export-excel', [App\Http\Controllers\SuratIzinController::class, 'exportExcel'])->name('exportExcel');
Route::get('/surat/export-pdf', [App\Http\Controllers\SuratIzinController::class, 'exportPdf'])->name('exportPdf');
