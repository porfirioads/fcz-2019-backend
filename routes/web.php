<?php

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

Route::get('/', 'DashboardController@showHomeScreen')->name('home');;

Route::get('users/register', 'UsuarioController@showRegisterForm')
    ->name('user.register.view');

Route::post('users/register', 'UsuarioController@register')
    ->name('user.register.action');

Route::get('users/login', 'UsuarioController@showLoginForm')
    ->name('user.login.view');

Route::post('users/login', 'UsuarioController@login')
    ->name('user.login.action');

Route::get('users/logout', 'UsuarioController@logout')
    ->name('user.logout.action');

Route::get('/eventos/list', 'EventoController@showListaEventos')
    ->name('evento.list.view');

Route::get('/eventos/create', 'EventoController@showCreateEventoForm')
    ->name('evento.create.view');

Route::post('/eventos/create', 'EventoController@createEvento')
    ->name('evento.create.action');

Route::get('/eventos/edit', 'EventoController@showEditEventoForm')
    ->name('evento.edit.view');

Route::post('/eventos/edit', 'EventoController@editEvento')
    ->name('evento.edit.action');

Route::post('/eventos/delete', 'EventoController@deleteEvento')
    ->name('evento.delete.action');

