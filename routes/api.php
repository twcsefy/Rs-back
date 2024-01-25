<?php

use App\Http\Controllers\ADMController;
use App\Http\Controllers\ClientesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Cliente

Route::post('cadastro/Cliente', [ClientesController::class, 'store']); 

Route::put('update/cliente', [ClientesController::class, 'editarCliente']);

Route::get('all/cliente', [ClientesController::class, 'retornarTodosClientes']);

Route::delete('excluir/cliente/{id}', [ClientesController::class, 'excluirCliente']);

Route::post('pesquisar/nome/cliente', [ClientesController::class, 'pesquisarClientePorNome']);

Route::post('pesquisar/cpf/cliente', [ClientesController::class, 'pesquisarClientePorCpf']);

Route::post('pesquisar/celular/cliente', [ClientesController::class, 'pesquisarClientePorCelular']);

Route::post('pesquisar/email/cliente', [ClientesController::class, 'pesquisarClientePorEmail']);

Route::get('find/cliente/{id}',[ClientesController::class, 'pesquisarPorId']);

Route::put ('recuperar/senha/cliente', [ClientesController::class, 'recuperarSenha']);

//ADM

Route::put ('recuperar/senha/ADM', [ADMController::class, 'recuperarSenha']);