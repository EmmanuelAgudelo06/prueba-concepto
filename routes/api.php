<?php

use App\Http\Controllers\DetectionDataController;
use Illuminate\Routing\Route;

Route::post('/send-data-v1', [DetectionDataController::class, 'storeHttp']);
Route::post('/send-data-v2', [DetectionDataController::class, 'storeSoap']);
