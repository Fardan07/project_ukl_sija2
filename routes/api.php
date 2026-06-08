<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Report;

Route::post('/login', [AuthController::class, 'apiLogin']);

Route::get('/reports', function () {
    return response()->json(Report::all());
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});