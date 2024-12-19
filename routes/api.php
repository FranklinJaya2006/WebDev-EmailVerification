<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Library;

Route::post('/register', [AuthController::class, 'register']);
Route::get('/librarian/{id}', [AdminController::class, 'showLibrarianById']); 
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk verifikasi email (tanpa menggunakan form web)
Route::get('/email/verify/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    //  book
    Route::post('/storebook/{id}', [Library::class, 'storeBook']);

    // cd
    Route::post('/storecd/{id}', [Library::class, 'storeCd']);

    // newspaper
    Route::post('/storenewspaper/{id}', [Library::class, 'storeNewspaper']);

    // dvd
    Route::post('/storedvd/{id}', [Library::class, 'storeDvd']);

    // jurnal
    Route::post('/storejurnal/{id}', [Library::class, 'storeJurnal']);

    Route::put('/updatenewspaper/{id}', [Library::class, 'updateNewspaper']);
    Route::delete('/deletenewspaper/{id}', [Library::class, 'deleteNewspaper']);

    Route::put('/updatebook/{id}', [Library::class, 'updateBook']);
    Route::delete('/deletebook/{id}', [Library::class, 'deleteBook']);

    Route::put('/updatedvd/{id}', [Library::class, 'updateDvd']);
    Route::delete('/deletedvd/{id}', [Library::class, 'deleteDvd']);

    Route::put('/updatejurnal/{id}', [Library::class, 'updateJurnal']);
    Route::delete('/deletejurnal/{id}', [Library::class, 'deleteJurnal']);

    Route::put('/updatecd/{id}', [Library::class, 'updateCd']);
    Route::delete('/deletecd/{id}', [Library::class, 'deleteCd']);
});