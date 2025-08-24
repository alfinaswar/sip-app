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
Route::resource('surat-izin-history', App\Http\Controllers\RiwayatUpdateController::class);
Route::get('/surat-datatable', [App\Http\Controllers\SuratIzinController::class, 'datatable'])->name('datatable');
Route::get('/update-password', [App\Http\Controllers\SuratIzinController::class, 'updatepassword'])->name('updatepassword');
Route::POST('/simpan-password', [App\Http\Controllers\SuratIzinController::class, 'simpanpassword'])->name('simpanpassword');
Route::get('/history-datatable', [App\Http\Controllers\SuratIzinController::class, 'History'])->name('History');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/surat/export-excel', [App\Http\Controllers\SuratIzinController::class, 'exportExcel'])->name('exportExcel');
Route::POST('/surat/import-excel', [App\Http\Controllers\SuratIzinController::class, 'importExcel'])->name('importExcel');
Route::get('/surat/export-pdf', [App\Http\Controllers\SuratIzinController::class, 'exportPdf'])->name('exportPdf');
Route::get('/surat/export-excel-history', [App\Http\Controllers\SuratIzinController::class, 'exportExcelHistory'])->name('exportExcelHistory');
Route::get('/surat/export-pdf-history', [App\Http\Controllers\SuratIzinController::class, 'exportPdfHistory'])->name('exportPdfHistory');
