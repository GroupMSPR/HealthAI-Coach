<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users', function (Request $request) {
        if (! $request->user()->tokenCan('view_users')) {
            return $request->user();
        }

        return \App\Models\User::all()->forPage($request->path(), 10);
    });
});
