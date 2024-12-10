<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Library;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\BookLoanController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/librarian', [Library::class, 'filter'])->name('librarian');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');


Route::get('/create-item', [Library::class, 'createItem'])->name('createItem');

Route::get('/create-book', function () {
    return view('createbook');
})->name('createbook');

Route::get('/create-jurnal', function () {
    return view('createjurnal');
})->name('createjurnal');

Route::get('/create-cd', function () {
    return view('createcd');
})->name('createcd');

Route::get('/create-newspaper', function () {
    return view('createnewspaper');
})->name('createnewspaper');

Route::get('/create-dvd', function () {
    return view('createdvd');
})->name('createdvd');


Route::post('/store-book', [Library::class, 'storeBook'])->name('storebook');
Route::post('/store-jurnal', [Library::class, 'storeJurnal'])->name('storejurnal');
Route::post('/store-cd', [Library::class, 'storeCd'])->name('storecd');
Route::post('/store-newspaper', [Library::class, 'storeNewspaper'])->name('storenewspaper');
Route::post('/store-dvd', [Library::class, 'storeDvd'])->name('storedvd');


//update
// Route untuk menampilkan form edit untuk setiap kategori
Route::get('/edit-book/{id}', [Library::class, 'editBook'])->name('editbook');
Route::get('/edit-jurnal/{id}', [Library::class, 'editJurnal'])->name('editjurnal');
Route::get('/edit-cd/{id}', [Library::class, 'editCd'])->name('editcd');
Route::get('/edit-newspaper/{id}', [Library::class, 'editNewspaper'])->name('editnewspaper');
Route::get('/edit-dvd/{id}', [Library::class, 'editDvd'])->name('editdvd');

// Route untuk melakukan update data
Route::post('/update-book/{id}', [Library::class, 'updateBook'])->name('updatebook');
Route::post('/update-jurnal/{id}', [Library::class, 'updateJurnal'])->name('updatejurnal');
Route::post('/update-cd/{id}', [Library::class, 'updateCd'])->name('updatecd');
Route::post('/update-newspaper/{id}', [Library::class, 'updateNewspaper'])->name('updatenewspaper');
Route::post('/update-dvd/{id}', [Library::class, 'updateDvd'])->name('updatedvd');

// Route untuk menghapus item untuk setiap kategori
Route::delete('/delete-book/{id}', [Library::class, 'deleteBook'])->name('deletebook');
Route::delete('/delete-jurnal/{id}', [Library::class, 'deleteJurnal'])->name('deletejurnal');
Route::delete('/delete-cd/{id}', [Library::class, 'deleteCd'])->name('deletecd');
Route::delete('/delete-newspaper/{id}', [Library::class, 'deleteNewspaper'])->name('deletenewspaper');
Route::delete('/delete-dvd/{id}', [Library::class, 'deleteDvd'])->name('deletedvd');




/// Menampilkan daftar librarian
Route::get('/admin', [AdminController::class, 'showLibrarians'])->name('admin');

// Hapus librarian
Route::delete('/admin/{id}', [AdminController::class, 'deleteLibrarian'])->name('deleteLibrarian');


Route::post('/librarian/create-loan', [BookLoanController::class, 'createLoan'])->name('createLoan');

// Admin mengapprove atau menolak peminjaman
Route::post('/admin/approve-loan/{id}', [BookLoanController::class, 'approveLoan'])->name('approveLoan');
Route::post('/admin/reject-loan/{id}', [BookLoanController::class, 'rejectLoan'])->name('rejectLoan');

// Hapus item (admin)
Route::delete('/admin/delete-item/{id}', [BookLoanController::class, 'deleteItem'])->name('deleteItem');