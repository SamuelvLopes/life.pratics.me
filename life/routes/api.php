<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PacienteAuthController;
use App\Http\Controllers\Auth\MedicoAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\MedicoController;
use App\Http\Controllers\Admin\EspecialidadeController;
use App\Http\Controllers\Admin\ProcedimentoController;
use App\Http\Controllers\Admin\PlanoSaudeController;
use App\Http\Controllers\Admin\PacienteController;

Route::group(['prefix' => 'paciente'], function () {
    Route::post('register', [PacienteAuthController::class, 'register']);
    Route::post('login', [PacienteAuthController::class, 'login']);
    Route::post('logout', [PacienteAuthController::class, 'logout'])->middleware('auth:paciente');
    Route::get('me', [PacienteAuthController::class, 'me'])->middleware('auth:paciente');
});

Route::group(['prefix' => 'medico'], function () {
    Route::post('register', [MedicoAuthController::class, 'register']);
    Route::post('login', [MedicoAuthController::class, 'login']);
    Route::post('logout', [MedicoAuthController::class, 'logout'])->middleware('auth:medico');
    Route::get('me', [MedicoAuthController::class, 'me'])->middleware('auth:medico');
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('register', [AdminAuthController::class, 'register'])->middleware('auth:admin');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin');
    Route::get('me', [AdminAuthController::class, 'me'])->middleware('auth:admin');

    Route::apiResource('medico', MedicoController::class);
    Route::apiResource('especialidade', EspecialidadeController::class);
    Route::apiResource('procedimento', ProcedimentoController::class);
    Route::apiResource('plano', PlanoSaudeController::class);
    Route::apiResource('paciente', PacienteController::class);
});

Route::get('/', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('login');
