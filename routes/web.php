<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/documents', [DocumentController::class, 'index'])->name("documents.index");
Route::get('/documents/create', [DocumentController::class, 'create'])->name("documents.create");
Route::post('/documents', [DocumentController::class, 'store'])->name("documents.store");
Route::get('/documents/{id}', [DocumentController::class, 'show'])->name("documents.show");
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name("documents.edit");
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name("documents.update");
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name("documents.destroy");