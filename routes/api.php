<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ExpensesControllerAPI;

   
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
         
Route::middleware('auth:sanctum')->group( function () {
    Route::get('expenses', [ExpensesControllerAPI::class, 'index'])->name('expenses.index'); // Menampilkan daftar catatan pengeluaran
Route::get('expenses/create', [ExpensesControllerAPI::class, 'create'])->name('expenses.create'); // Menampilkan formulir tambah catatan pengeluaran
Route::post('expenses', [ExpensesControllerAPI::class, 'store'])->name('expenses.store'); // Menyimpan catatan pengeluaran baru
Route::get('expenses/{id}', [ExpensesControllerAPI::class, 'show'])->name('expenses.show');// Menampilkan detail catatan pengeluaran
Route::get('expenses/{id}/edit', [ExpensesControllerAPI::class, 'edit'])->name('expenses.edit'); // Menampilkan formulir edit catatan pengeluaran
Route::put('expenses/{id}', [ExpensesControllerAPI::class, 'update'])->name('expenses.update'); // Menyimpan perubahan pada catatan pengeluaran
Route::delete('expenses/{id}', [ExpensesControllerAPI::class, 'destroy'])->name('expenses.destroy'); // Menghapus catatan pengeluaran

Route::post('expenses/filter', [ExpensesControllerAPI::class, 'filterByDate'])->name('expenses.filter');
});