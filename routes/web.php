<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Criação das rotas
// Rota para formulário de registro de um usuário
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
// Rota para registrar um usuário
Route::post('/register', [UserController::class, 'register']); // Cadastrar usuário



Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');
// Rota para mostrar formulário de autenticação  - LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Rota para processar login
Route::post('/login', [LoginController::class, 'login']); // Função de login
// Rota para criar um novo usuário (formulário de criação)
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//Rota para listar usuários (acessível apenas por administradores)
Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Rota para editar um usuário existente
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Rota para deletar um usuário
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
// Rota para atualizar os dados de um usuário
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
// Rota para armazenar um novo usuário
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
// Rota para atualizar dados de usuário
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth');
// Rota para deletar um usuário.
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');
