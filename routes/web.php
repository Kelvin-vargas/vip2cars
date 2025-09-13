<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SurveyController;


Route::get('/', function () {
    return redirect()->route('vehicles.index');
});

Route::resource('customers', CustomerController::class);
Route::resource('vehicles', VehicleController::class);
Route::resource('surveys', SurveyController::class)->only(['store']);
