<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginasController;

// Rotas FocusMind
Route::get('/', [PaginasController::class, 'dashboard']);
Route::get('/tarefas', [PaginasController::class, 'tarefas']);
Route::get('/timer', [PaginasController::class, 'timer']);
Route::get('/grupos', [PaginasController::class, 'grupos']);

// Rotas antigas mantidas
Route::get('/sobre', [PaginasController::class, 'sobre']);
Route::get('/contato', [PaginasController::class, 'colaboracao']);
