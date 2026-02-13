<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Middleware\SetLocale;

// Rutas sin prefijo (inglés por defecto)
Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('files.index');
    Route::post('/files', [FileController::class, 'store'])
        ->middleware('throttle:2,1')
        ->name('files.store');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
});

// Rutas con prefijo /es (español)
Route::prefix('es')->middleware([SetLocale::class])->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('files.index.es');
    Route::post('/files', [FileController::class, 'store'])
        ->middleware('throttle:2,1')
        ->name('files.store.es');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download.es');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy.es');
});


