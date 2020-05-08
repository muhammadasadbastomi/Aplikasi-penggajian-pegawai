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

    Route::get('/pegawai/periode/index', 'PeriodeController@index')->name('periodeUserIndex');
    Route::get('/pegawai/periode/detail/{id}', 'PeriodeController@show')->name('periodeUserShow');
    Route::get('/laporan/cetak_periode', 'PeriodeController@cetak_pdf')->name('periodePdf');

    // route absensi user
    Route::get('/pegawai/absensi/index/{id}', 'AbsensiController@index')->name('absensiUserIndex');
    Route::get('/pegawai/absensi/detail/{id}', 'AbsensiController@show')->name('absensiUserShow');
    Route::get('/pegawai/absensi/hadir', 'AbsensiController@hadir')->name('absensiUserHadir');
    Route::post('/pegawai/absensi/create', 'AbsensiController@store')->name('absensiUserStore');
    Route::get('/pegawai/absensi/edit/{id}', 'AbsensiController@edit')->name('absensiUserEdit');
    Route::put('/pegawai/absensi/edit/{id}', 'AbsensiController@update')->name('absensiUserUpdate');
    Route::delete('/pegawai/absensi/delete/{id}', 'AbsensiController@destroy')->name('absensiUserDestroy');
    Route::get('/laporan/cetak_absensi', 'AbsensiController@cetak_pdf')->name('absensiPdf');
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
    Route::get('/laporan/cetak_pegawai', 'PegawaiController@cetak_pdf')->name('pegawaiPdf');

    Route::get('/admin/absensi/index/{id}', 'AbsensiController@index')->name('absensiIndex');
    Route::get('/admin/absensi/detail/{id}', 'AbsensiController@show')->name('absensiShow');
    Route::get('/admin/absensi/create', 'AbsensiController@create')->name('absensiCreate');
    Route::post('/admin/absensi/create', 'AbsensiController@store')->name('absensiStore');
    Route::get('/admin/absensi/edit/{id}', 'AbsensiController@edit')->name('absensiEdit');
    Route::put('/admin/absensi/edit/{id}', 'AbsensiController@update')->name('absensiUpdate');
    Route::delete('/admin/absensi/delete/{id}', 'AbsensiController@destroy')->name('absensiDestroy');
    Route::get('/laporan/cetak_absensi', 'AbsensiController@cetak_pdf')->name('absensiPdf');

    Route::get('/admin/periode/index', 'PeriodeController@index')->name('periodeIndex');
    Route::get('/admin/periode/detail/{id}', 'PeriodeController@show')->name('periodeShow');
    Route::get('/admin/periode/create', 'PeriodeController@create')->name('periodeCreate');
    Route::post('/admin/periode/create', 'PeriodeController@store')->name('periodeStore');
    Route::get('/admin/periode/edit/{id}', 'PeriodeController@edit')->name('periodeEdit');
    Route::put('/admin/periode/edit/{id}', 'PeriodeController@update')->name('periodeUpdate');
    Route::delete('/admin/periode/delete/{id}', 'PeriodeController@destroy')->name('periodeDestroy');
    Route::get('/laporan/cetak_periode', 'PeriodeController@cetak_pdf')->name('periodePdf');

    Route::get('/admin/gaji/periode/index', 'PeriodegajiController@index')->name('GajiperiodeIndex');
    Route::post('/admin/gaji/periode/index', 'PeriodegajiController@create')->name('GajiperiodeCreate');
    Route::get('/admin/gaji/periode/edit/{id}', 'PeriodegajiController@edit')->name('GajiperiodeEdit');
    Route::put('/admin/gaji/periode/edit/{id}', 'PeriodegajiController@update')->name('GajiperiodeUpdate');
    Route::delete('/admin/gaji/periode/delete/{id}', 'PeriodegajiController@delete')->name('GajiperiodeDelete');
    Route::get('/laporan/cetak_periode', 'PeriodegajiController@cetak_pdf')->name('lihatkaryawanPDF');

    Route::get('/admin/gaji/periode/karyawan/index/{id}', 'PeriodegajiController@karyawan')->name('lihatkaryawanIndex');
    Route::patch('/admin/gaji/periode/karyawan/index/{id}', 'PeriodegajiController@createkaryawan')->name('lihatkaryawanIndex');
    Route::delete('/admin/gaji/periode/karyawan/delete/{id}', 'PeriodegajiController@deletekaryawan')->name('lihatkaryawanDelete');
    Route::get('/laporan/cetak_periode', 'PeriodegajiController@cetak_pdf')->name('lihatkaryawanPDF');

    Route::get('/admin/gaji/periode/pegawai/index/{id}', 'PeriodegajiController@pegawai')->name('lihatpegawaiIndex');
    Route::patch('/admin/gaji/periode/pegawai/index/{id}', 'PeriodegajiController@createpegawai')->name('lihatpegawaiIndex');
    Route::delete('/admin/gaji/periode/pegawai/delete/{id}', 'PeriodegajiController@deletepegawai')->name('lihatpegawaiDelete');
    Route::get('/laporan/cetak_periode', 'PeriodegajiController@cetak_pdf')->name('lihatpegawaiPDF');

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
    Route::get('/laporan/cetak_golongan', 'GolonganController@cetak_pdf')->name('golonganPdf');

    Route::get('/admin/user/index', 'UserController@index')->name('userIndex');
    Route::get('/admin/user/profile/{id}', 'UserController@show')->name('userShow');
    Route::put('/admin/user/profile/{id}', 'UserController@update')->name('userUpdate');
    Route::get('/admin/user/create', 'UserController@create')->name('userCreate');
    Route::post('/admin/user/create', 'UserController@store')->name('userStore');
    Route::delete('/admin/user/delete/{id}', 'UserController@destroy')->name('userDestroy');

    Route::get('/admin/pegawai/filter', 'PegawaiController@filter')->name('pegawaiFilter');
});
