<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\WeatherController;

// Route for calculating averages and displaying results
Route::get('/weather/averages', [WeatherController::class, 'calculateAverages'])->name('weather.averages');

// Route for visualizing trends
Route::get('/weather/visualize', [WeatherController::class, 'visualizeTrends'])->name('weather.visualize');


Route::get('/upload', [WeatherController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [WeatherController::class, 'uploadCSV'])->name('upload.csv');

