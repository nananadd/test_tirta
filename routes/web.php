<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableAController;
use App\Http\Controllers\TableBController;
use App\Http\Controllers\TableCController;
use App\Http\Controllers\SalesController;

// ROUTE DASHBOARD (Halaman Utama)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ROUTE TABEL A
Route::get('/table-a', [TableAController::class, 'index'])->name('table_a.index');
Route::post('/table-a/store', [TableAController::class, 'store'])->name('table_a.store');
Route::post('/table-a/import', [TableAController::class, 'importExcel'])->name('table_a.import');
Route::get('/table-a/export/excel', [TableAController::class, 'exportExcel'])->name('table_a.export.excel');
Route::get('/table-a/export/pdf', [TableAController::class, 'exportPdf'])->name('table_a.export.pdf');
Route::put('/table-a/{id}', [TableAController::class, 'update'])->name('table_a.update');
Route::delete('/table-a/{id}', [TableAController::class, 'destroy'])->name('table_a.destroy');

// ROUTE TABEL B
Route::get('/table-b', [TableBController::class, 'index'])->name('table_b.index');
Route::post('/table-b/store', [TableBController::class, 'store'])->name('table_b.store');
Route::post('/table-b/import', [TableBController::class, 'importExcel'])->name('table_b.import');
Route::get('/table-b/export/excel', [TableBController::class, 'exportExcel'])->name('table_b.export.excel');
Route::get('/table-b/export/pdf', [TableBController::class, 'exportPdf'])->name('table_b.export.pdf');
Route::put('/table-b/{id}', [TableBController::class, 'update'])->name('table_b.update');
Route::delete('/table-b/{id}', [TableBController::class, 'destroy'])->name('table_b.destroy');

// ROUTE TABEL C
Route::get('/table-c', [TableCController::class, 'index'])->name('table_c.index');
Route::post('/table-c/store', [TableCController::class, 'store'])->name('table_c.store');
Route::post('/table-c/import', [TableCController::class, 'importExcel'])->name('table_c.import');
Route::get('/table-c/export/excel', [TableCController::class, 'exportExcel'])->name('table_c.export.excel');
Route::get('/table-c/export/pdf', [TableCController::class, 'exportPdf'])->name('table_c.export.pdf');
Route::put('/table-c/{id}', [TableCController::class, 'update'])->name('table_c.update');
Route::delete('/table-c/{id}', [TableCController::class, 'destroy'])->name('table_c.destroy');

// ROUTE TABEL D (SALES)
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index'); 
Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
Route::post('/sales/import', [SalesController::class, 'importExcel'])->name('sales.import');
Route::get('/sales/export/excel', [SalesController::class, 'exportExcel'])->name('sales.export.excel');
Route::get('/sales/export/pdf', [SalesController::class, 'exportPdf'])->name('sales.export.pdf');
Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::delete('/sales/{id}', [SalesController::class, 'destroy'])->name('sales.destroy');