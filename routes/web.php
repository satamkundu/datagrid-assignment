<?php

use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::post('/families', [FamilyController::class, 'store'])->name('families.store');
Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create');
Route::get('/families/{id}', [FamilyController::class, 'show'])->name('families.show');