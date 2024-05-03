<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index'); // Menampilkan daftar catatan pengeluaran
Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create'); // Menampilkan formulir tambah catatan pengeluaran
Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store'); // Menyimpan catatan pengeluaran baru
Route::get('expenses/{id}', [ExpenseController::class, 'show'])->name('expenses.show');// Menampilkan detail catatan pengeluaran
Route::get('expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit'); // Menampilkan formulir edit catatan pengeluaran
Route::put('expenses/{id}', [ExpenseController::class, 'update'])->name('expenses.update'); // Menyimpan perubahan pada catatan pengeluaran
Route::delete('expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy'); // Menghapus catatan pengeluaran

Route::post('expenses/filter', [ExpenseController::class, 'filterByDate'])->name('expenses.filter');

Auth::routes();

Route::get('/home', [ExpenseController::class, 'index'])->name('home');

