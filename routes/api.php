<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Library;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/librarian/{id}', [AdminController::class, 'showLibrarianById']); 

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

//  book
Route::post('/storebook/{id}', [Library::class, 'storeBook']);
Route::put('/updatebook/{id}', [Library::class, 'updateBook']);
Route::delete('/deletebook/{id}', [Library::class, 'deleteBook']);

// cd
Route::post('/storecd/{id}', [Library::class, 'storeCd']);
Route::put('/updatecd/{id}', [Library::class, 'updateCd']);
Route::delete('/deletecd/{id}', [Library::class, 'deleteCd']);

// newspaper
Route::post('/storenewspaper/{id}', [Library::class, 'storeNewspaper']);
Route::put('/updatenewspaper/{id}', [Library::class, 'updateNewspaper']);
Route::delete('/deletenewspaper/{id}', [Library::class, 'deleteNewspaper']);

// dvd
Route::post('/storedvd/{id}', [Library::class, 'storeDvd']);
Route::put('/updatedvd/{id}', [Library::class, 'updateDvd']);
Route::delete('/deletedvd/{id}', [Library::class, 'deleteDvd']);

// jurnal
Route::post('/storejurnal/{id}', [Library::class, 'storeJurnal']);
Route::put('/updatejurnal/{id}', [Library::class, 'updateJurnal']);
Route::delete('/deletejurnal/{id}', [Library::class, 'deleteJurnal']);
