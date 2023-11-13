<?php

use SyntheticCustomFields\Http\Controllers\CustomFieldController;
use Illuminate\Support\Facades\Route;

// Route::get('test', [CustomFieldController::class, 'index']);
Route::get('/feedData', [CustomFieldController::class, 'feedData']);
Route::get('/people/component/table/data', [CustomFieldController::class, 'getTaskData']);
Route::get('/test', [CustomFieldController::class, 'generateFilterFields']);
