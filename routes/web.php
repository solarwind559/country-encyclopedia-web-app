<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', [CountryController::class, 'index'])->name('home');
Route::get('/search', [CountryController::class, 'search'])->name('countries.search');
Route::get('/favorites', [CountryController::class, 'showFavorites'])->name('countries.showfavorites');
Route::get('/countries/{id}', [CountryController::class, 'show'])->name('countries.show');
Route::post('/countries/{id}/favorites', [CountryController::class, 'toggleFavorite'])->name('countries.favorites');
Route::get('/languages/{language}', [CountryController::class, 'countriesByLanguage'])->name('countries.language');
