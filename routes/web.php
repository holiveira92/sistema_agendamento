<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(!Auth::guest()){
        return view('home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rotas do cadastro de usuários
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/edit/{id}/', [App\Http\Controllers\UserController::class, 'edit'])->name('/user/edit/');
Route::get('/user/update/{id}/', [App\Http\Controllers\UserController::class, 'update'])->name('/user/update/');
Route::get('/user/delete/{id}/', [App\Http\Controllers\UserController::class, 'delete'])->name('/user/delete/');

//Rotas do cadastro de médicos
Route::get('/medico', [App\Http\Controllers\MedicoController::class, 'index'])->name('medico');
Route::get('/medico/create/', [App\Http\Controllers\MedicoController::class, 'create'])->name('/medico/create/');
Route::get('/medico/edit/{id}/', [App\Http\Controllers\MedicoController::class, 'edit'])->name('/medico/edit/');
Route::get('/medico/update/{id}/', [App\Http\Controllers\MedicoController::class, 'update'])->name('/medico/update/');
Route::get('/medico/delete/{id}/', [App\Http\Controllers\MedicoController::class, 'delete'])->name('/medico/delete/');

//Rotas do cadastro de Pacientes
Route::get('/paciente', [App\Http\Controllers\PacienteController::class, 'index'])->name('paciente');
Route::get('/paciente/create/', [App\Http\Controllers\PacienteController::class, 'create'])->name('/paciente/create/');
Route::get('/paciente/edit/{id}/', [App\Http\Controllers\PacienteController::class, 'edit'])->name('/paciente/edit/');
Route::get('/paciente/update/{id}/', [App\Http\Controllers\PacienteController::class, 'update'])->name('/paciente/update/');
Route::get('/paciente/delete/{id}/', [App\Http\Controllers\PacienteController::class, 'delete'])->name('/paciente/delete/');

//Rotas do cadastro de Agendamentos
Route::get('/agendamentos', [App\Http\Controllers\AgendamentosController::class, 'index'])->name('agendamentos');
Route::get('/agendamentos/create/', [App\Http\Controllers\AgendamentosController::class, 'create'])->name('/agendamentos/create/');
Route::get('/agendamentos/edit/{id}/', [App\Http\Controllers\AgendamentosController::class, 'edit'])->name('/agendamentos/edit/');
Route::get('/agendamentos/update/{id}/', [App\Http\Controllers\AgendamentosController::class, 'update'])->name('/agendamentos/update/');
Route::get('/agendamentos/delete/{id}/', [App\Http\Controllers\AgendamentosController::class, 'delete'])->name('/agendamentos/delete/');