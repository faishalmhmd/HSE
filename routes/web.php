<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
// controller
use App\Http\Controllers\User\KaryawanController;
use App\Http\Controllers\User\MandorController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin Middleware
Route::middleware(['auth','userMiddleware'])->group(function() {
    Route::get('dashboard',[UserController::class,'index'])->name('dashboard');
    // web karyawan controller
    Route::get('karyawan',[KaryawanController::class,'index'])->name('karyawan');
    Route::get('karyawan/add',[KaryawanController::class,'add'])->name('add-karyawan');
    Route::get('karyawan/{id}/edit',[KaryawanController::class,'edit'])->name('edit-karyawan');
    // api karyawan controller
    Route::get('get-data-karyawan',[KaryawanController::class,'getDatakaryawan'])->name('get-data-karyawan');
    Route::get('search-data-karyawan',[KaryawanController::class,'searchDataKaryawan'])->name('search-data-karyawan');
    Route::post('add-data-karyawan',[KaryawanController::class,'insertDataKaryawan'])->name('insert-data-karyawan');
    Route::post('edit-data-karyawan',[KaryawanController::class,'editDataKaryawan'])->name('edit-data-karyawan');
    // web mandor controller
    Route::get('mandor',[MandorController::class,'index'])->name('mandor');
    Route::get('mandor/add',[MandorController::class,'add'])->name('add-mandor');
    // api mandor controller
    Route::get('get-data-mandor',[MandorController::class,'getDataMandor'])->name('get-data-mandor');
    Route::get('search-data-mandor',[MandorController::class,'searchDataMandor'])->name('search-data-mandor');
    // export pdf 
    Route::get('pdf-data-mandor',[MandorController::class,'exportDataMandor'])->name('pdf-data-mandor');
    Route::get('pdf-data-karyawan',[KaryawanController::class,'exportDataKaryawan'])->name('pdf-data-karyawan');
});

// user middleware
Route::middleware(['auth','adminMiddleware'])->group(function() {
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
});