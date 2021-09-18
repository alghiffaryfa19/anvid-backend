<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\HospitalController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('diagnosa', DiagnosaController::class);
Route::post('jawaban/{id}', [JawabanController::class, 'store'])->name('jawaban');
Route::get('jawaban/{id}', [JawabanController::class, 'edit'])->name('analisa');

// Route::get('nearest', [HospitalController::class, 'nearest']);
Route::get('nearest/{lat}/{lon}', [HospitalController::class, 'nearest']);

require __DIR__.'/auth.php';
