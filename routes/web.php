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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/index', 'AdminController@index')->name('adminIndex');

Route::get('/admin/jabatan/index', 'JabatanController@index')->name('jabatanIndex');
Route::get('/admin/jabatan/detail/{id}', 'JabatanController@show')->name('jabatanShow');
Route::get('/admin/jabatan/create', 'JabatanController@create')->name('jabatanCreate');
Route::post('/admin/jabatan/create', 'JabatanController@store')->name('jabatanStore');
Route::get('/admin/jabatan/edit/{id}', 'JabatanController@edit')->name('jabatanEdit');
Route::put('/admin/jabatan/edit/{id}', 'JabatanController@update')->name('jabatanUpdate');
Route::delete('/admin/jabatan/delete/{id}', 'JabatanController@destroy')->name('jabatanDestroy');