<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\KaryawanController;

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('karyawans', KaryawanController::class);
});
