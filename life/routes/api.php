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
    Route::post('login', [PacienteAuthController::class, 'login']);
    Route::post('logout', [PacienteAuthController::class, 'logout'])->middleware('auth:paciente');
    Route::get('me', [PacienteAuthController::class, 'me'])->middleware('auth:paciente');

    Route::post('consultas', [PacienteController::class, 'marcarConsulta'])->middleware('auth:paciente');
    Route::get('consultas', [PacienteController::class, 'listarConsultas'])->middleware('auth:paciente');
    Route::get('consultas/{consultaId}', [PacienteController::class, 'mostrarConsulta'])->middleware('auth:paciente');
});


Route::group(['prefix' => 'medico'], function () {
    
    Route::post('login', [MedicoAuthController::class, 'login']);
    Route::post('logout', [MedicoAuthController::class, 'logout'])->middleware('auth:medico');
    Route::get('me', [MedicoAuthController::class, 'me'])->middleware('auth:medico');

    Route::get('consultas', [MedicoController::class, 'listConsultas'])->middleware('auth:medico');
    Route::get('consultas/{consultaId}', [MedicoController::class, 'showConsulta'])->middleware('auth:medico');
    Route::get('pacientes', [MedicoController::class, 'listPacientes'])->middleware('auth:medico');
    Route::get('pacientes/{pacienteId}', [MedicoController::class, 'showPaciente'])->middleware('auth:medico');
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('register', [AdminAuthController::class, 'register'])->middleware('auth:admin');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->middleware('auth:admin');
    Route::get('me', [AdminAuthController::class, 'me'])->middleware('auth:admin');

    Route::apiResource('medico', MedicoController::class)->middleware('auth:admin');
    Route::apiResource('especialidade', EspecialidadeController::class)->middleware('auth:admin');
    Route::apiResource('procedimento', ProcedimentoController::class)->middleware('auth:admin');
    Route::apiResource('plano', PlanoSaudeController::class)->middleware('auth:admin');
    Route::apiResource('paciente', PacienteController::class)->middleware('auth:admin');
});

Route::get('/', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('login');
