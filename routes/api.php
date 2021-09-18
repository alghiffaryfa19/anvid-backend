<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JsonController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('diagnosa/store', [JsonController::class, 'mulai_diag']);
Route::get('diagnosa/{id}', [JsonController::class, 'isi']);
Route::post('diagnosa/{id}', [JsonController::class, 'jawab']);
Route::get('hospital/', [JsonController::class, 'nearest']);
Route::get('/statistik', [JsonController::class, 'statistik'])->name('api.statistik');
Route::get('/latest-article', [JsonController::class, 'latest_article'])->name('api.latest_article');
Route::get('/article', [JsonController::class, 'article'])->name('api.article');
Route::get('/article/{article}', [JsonController::class, 'detail_article'])->name('api.detail_article');
