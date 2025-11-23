<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginasController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\ProdutoController;


Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/adicionar', [ProdutoController::class, 'store']);
Route::get('/contato', [ContatoController::class, 'contato']);
Route::get('/', [PaginasController::class, 'index']);
Route::get('/sobre', [PaginasController::class, 'sobre']);