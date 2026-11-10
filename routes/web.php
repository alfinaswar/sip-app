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
    return view('auth.login');
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

Route::middleware('auth')->prefix('data-master')->name('master-data.')->group(function () {
    Route::get('/{tab?}', [App\Http\Controllers\MasterDataController::class, 'index'])
        ->where('tab', 'kpad|pangkat|korps|status')
        ->name('index');
    Route::post('/{tab}', [App\Http\Controllers\MasterDataController::class, 'store'])
        ->where('tab', 'kpad|pangkat|korps|status')
        ->name('store');
    Route::put('/{tab}/{id}', [App\Http\Controllers\MasterDataController::class, 'update'])
        ->where('tab', 'kpad|pangkat|korps|status')
        ->name('update');
    Route::delete('/{tab}/{id}', [App\Http\Controllers\MasterDataController::class, 'destroy'])
        ->where('tab', 'kpad|pangkat|korps|status')
        ->name('destroy');
});

Route::middleware('auth')->prefix('akses')->name('access.')->group(function () {
    Route::middleware('permission:user.manage')->group(function () {
        Route::get('/users', [App\Http\Controllers\UserAccessController::class, 'index'])->name('users.index');
        Route::post('/users', [App\Http\Controllers\UserAccessController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [App\Http\Controllers\UserAccessController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [App\Http\Controllers\UserAccessController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware('permission:role.manage')->group(function () {
        Route::get('/roles', [App\Http\Controllers\RolePermissionController::class, 'rolesIndex'])->name('roles.index');
        Route::post('/roles', [App\Http\Controllers\RolePermissionController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [App\Http\Controllers\RolePermissionController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [App\Http\Controllers\RolePermissionController::class, 'destroyRole'])->name('roles.destroy');

        Route::get('/permissions', [App\Http\Controllers\RolePermissionController::class, 'permissionsIndex'])->name('permissions.index');
        Route::post('/permissions', [App\Http\Controllers\RolePermissionController::class, 'storePermission'])->name('permissions.store');
        Route::put('/permissions/{permission}', [App\Http\Controllers\RolePermissionController::class, 'updatePermission'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [App\Http\Controllers\RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');
    });
});
