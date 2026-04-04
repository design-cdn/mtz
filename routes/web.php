<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApartamentController;
use App\Http\Controllers\ProgresController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| MTZ Nord Residence — Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Apartamente
Route::get('/apartamente/{slug}', [ApartamentController::class, 'show'])->name('apartament.show');

// Progres șantier
Route::get('/progres', [ProgresController::class, 'index'])->name('progres.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/oferta', [ContactController::class, 'oferta'])->name('contact.oferta');
