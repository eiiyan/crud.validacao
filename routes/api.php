<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Models\ItemVenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Clientes
Route::post('/clientes', [ClienteController::class, 'store']);

Route::get('/clientes', [ClienteController::class, 'index']);

Route::get('/clientes/{id}', [ClienteController::class, 'show']);

Route::put('/clientes/{id}', [ClienteController::class, 'update']);

Route::delete('/clientes/{id}', [ClienteController::class, 'delete']);

//Produtos
Route::post('/produtos', [ProdutoController::class, 'store']);

Route::get('/produtos', [ProdutoController::class, 'index']);

Route::get('/produtos/{id}', [ProdutoController::class, 'show']);

Route::put('/produtos/{id}', [ProdutoController::class, 'update']);

Route::delete('/produtos/{id}', [ProdutoController::class, 'delete']);

//Vendas
Route::post('/vendas', [VendaController::class, 'store']);

Route::get('/vendas', [VendaController::class, 'index']);

Route::get('/vendas/{id}', [VendaController::class, 'show']);

Route::put('/vendas/{id}', [VendaController::class, 'update']);

Route::delete('/vendas/{id}', [VendaController::class, 'delete']);

//ItensVendas
Route::get('/itens-venda', [ItemVendaController::class, 'index']);

Route::get('/itens-venda/{id}', [ItemVendaController::class, 'show']);

Route::put('/itens-venda/{id}', [ItemVendaController::class, 'update']);

Route::delete('/itens-venda/{id}', [ItemVendaController::class, 'delete']);

