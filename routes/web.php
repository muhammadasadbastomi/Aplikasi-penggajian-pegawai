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

//Route group Admin dan Pegawai Middleware
Route::group(['middleware' => ['auth', 'CheckRole:admin,pegawai']], function () {
    Route::get('/admin/index', 'AdminController@index')->name('adminIndex');
});

//Route group Admin Middleware
Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {

    Route::get('/admin/pegawai/index', 'PegawaiController@index')->name('pegawaiIndex');
    Route::get('/admin/pegawai/detail/{id}', 'PegawaiController@show')->name('pegawaiShow');
    Route::get('/admin/pegawai/create', 'PegawaiController@create')->name('pegawaiCreate');
    Route::post('/admin/pegawai/create', 'PegawaiController@store')->name('pegawaiStore');
    Route::get('/admin/pegawai/edit/{id}', 'PegawaiController@edit')->name('pegawaiEdit');
    Route::put('/admin/pegawai/edit/{id}', 'PegawaiController@update')->name('pegawaiUpdate');
    Route::delete('/admin/pegawai/delete/{id}', 'PegawaiController@destroy')->name('pegawaiDestroy');
    Route::get('/admin/pegawai/cetak_pdf', 'PegawaiController@cetak_pdf')->name('pegawaiPdf');

    Route::get('/admin/absensi/index', 'AbsensiController@index')->name('absensiIndex');
    Route::get('/admin/absensi/detail/{id}', 'AbsensiController@show')->name('absensiShow');
    Route::get('/admin/absensi/create', 'AbsensiController@create')->name('absensiCreate');
    Route::post('/admin/absensi/create', 'AbsensiController@store')->name('absensiStore');
    Route::get('/admin/absensi/edit/{id}', 'AbsensiController@edit')->name('absensiEdit');
    Route::put('/admin/absensi/edit/{id}', 'AbsensiController@update')->name('absensiUpdate');
    Route::delete('/admin/absensi/delete/{id}', 'AbsensiController@destroy')->name('absensiDestroy');
    Route::get('/admin/absensi/cetak_pdf', 'AbsensiController@cetak_pdf')->name('absensiPdf');

    Route::get('/admin/gaji/index', 'GajiController@index')->name('gajiIndex');
    Route::get('/admin/gaji/detail/{id}', 'GajiController@show')->name('gajiShow');
    Route::get('/admin/gaji/create', 'GajiController@create')->name('gajiCreate');
    Route::post('/admin/gaji/create', 'GajiController@store')->name('gajiStore');
    Route::get('/admin/gaji/edit/{id}', 'GajiController@edit')->name('gajiEdit');
    Route::put('/admin/gaji/edit/{id}', 'GajiController@update')->name('gajiUpdate');
    Route::delete('/admin/gaji/delete/{id}', 'GajiController@destroy')->name('gajiDestroy');
    Route::get('/admin/gaji/cetak_pdf', 'GajiController@cetak_pdf')->name('gajiPdf');

    Route::get('/admin/jabatan/index', 'JabatanController@index')->name('jabatanIndex');
    Route::get('/admin/jabatan/detail/{id}', 'JabatanController@show')->name('jabatanShow');
    Route::get('/admin/jabatan/create', 'JabatanController@create')->name('jabatanCreate');
    Route::post('/admin/jabatan/create', 'JabatanController@store')->name('jabatanStore');
    Route::get('/admin/jabatan/edit/{id}', 'JabatanController@edit')->name('jabatanEdit');
    Route::put('/admin/jabatan/edit/{id}', 'JabatanController@update')->name('jabatanUpdate');
    Route::delete('/admin/jabatan/delete/{id}', 'JabatanController@destroy')->name('jabatanDestroy');
    Route::get('/admin/jabatan/cetak_pdf', 'JabatanController@cetak_pdf')->name('jabatanPdf');

    Route::get('/admin/golongan/index', 'GolonganController@index')->name('golonganIndex');
    Route::get('/admin/golongan/detail/{id}', 'GolonganController@show')->name('golonganShow');
    Route::get('/admin/golongan/create', 'GolonganController@create')->name('golonganCreate');
    Route::post('/admin/golongan/create', 'GolonganController@store')->name('golonganStore');
    Route::get('/admin/golongan/edit/{id}', 'GolonganController@edit')->name('golonganEdit');
    Route::put('/admin/golongan/edit/{id}', 'GolonganController@update')->name('golonganUpdate');
    Route::delete('/admin/golongan/delete/{id}', 'GolonganController@destroy')->name('golonganDestroy');
    Route::get('/admin/golongan/cetak_pdf', 'GolonganController@cetak_pdf')->name('golonganPdf');

    Route::get('/admin/admin/index', 'UserController@index')->name('userIndex');
    Route::get('/admin/admin/detail', 'UserController@show')->name('userShow');
});
