<?php

use Illuminate\Support\Facades\Auth;
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
    return view('/auth/login');
});

Auth::routes();
Route::get('/admin/index', 'AdminController@index')->name('home');


//Route group Admin dan Pegawai Middleware
Route::group(['middleware' => ['auth', 'CheckRole:admin,pegawai']], function () {
    Route::get('/admin/index', 'AdminController@index')->name('adminIndex');

    //route lihat absensi kinerja pegawai
    Route::get('/pegawai/periode', 'AdminController@periode')->name('pegawaiperiode');
    Route::get('/pegawai/sidebar/absensi/{id}', 'AdminController@absensi')->name('pegawaiAbsensi');
    Route::get('/pegawai/sidebar/kinerja/{id}', 'AdminController@kinerja')->name('pegawaiKinerja');

    Route::get('/pegawai/periode/index', 'PeriodeController@index')->name('periodeUserIndex');
    Route::get('/pegawai/periode/detail/{id}', 'PeriodeController@show')->name('periodeUserShow');

    // route kinerja user
    Route::post('/kinerja/pegawai/absensi/index', 'AbsensiController@kinerjaindex')->name('absensiKinerjaIndex');

    // route absensi user
    Route::get('/pegawai/absensi/index/{id}', 'AbsensiController@index')->name('absensiUserIndex');
    Route::get('/pegawai/absensi/detail/{id}', 'AbsensiController@show')->name('absensiUserShow');
    Route::get('/pegawai/absensi/hadir', 'AbsensiController@hadir')->name('absensiUserHadir');
    Route::get('/pegawai/absensi/izin', 'AbsensiController@izin')->name('absensiUserIzin');
    Route::put('/pegawai/absensi/izin', 'AbsensiController@izinStore')->name('absensiUserIzinStore');
    Route::get('/pegawai/absensi/sakit', 'AbsensiController@sakit')->name('absensiUserSakit');
    Route::put('/pegawai/absensi/sakit', 'AbsensiController@sakitStore')->name('absensiUserSakitStore');
    Route::post('/pegawai/absensi/create', 'AbsensiController@store')->name('absensiUserStore');
    Route::get('/pegawai/absensi/edit/{id}', 'AbsensiController@edit')->name('absensiUserEdit');
    Route::put('/pegawai/absensi/edit/{id}', 'AbsensiController@update')->name('absensiUserUpdate');
    Route::delete('/pegawai/absensi/delete/{id}', 'AbsensiController@destroy')->name('absensiUserDestroy');

    // route absensi user
    Route::get('/pegawai/kinerja/index/{id}', 'HarianController@index')->name('kinerjaUserIndex');
    Route::patch('/pegawai/kinerja/index/{id}', 'HarianController@create')->name('kinerjaUsercreate');

    Route::get('/admin/user/index', 'UserController@index')->name('userIndex');
    Route::get('/admin/user/profile/{id}', 'UserController@show')->name('userShow');
    Route::put('/admin/user/profile/{id}', 'UserController@update')->name('userUpdate');
    Route::get('/admin/user/create', 'UserController@create')->name('userCreate');
    Route::post('/admin/user/create', 'UserController@store')->name('userStore');
    Route::delete('/admin/user/delete/{id}', 'UserController@destroy')->name('userDestroy');
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


    // Start kinerja Perbulan
    // Route::get('/admin/kinerja/periode/index', 'KinerjaController@periode')->name('kinerjaperiodeIndex');
    // Route::post('/admin/kinerja/periode/index', 'KinerjaController@tambah')->name('kinerjaperiodeCreate');
    // Route::get('/admin/kinerja/periode/edit/{id}', 'KinerjaController@ubah')->name('kinerjaperiodeEdit');
    // Route::put('/admin/kinerja/periode/edit/{id}', 'KinerjaController@ubahp')->name('kinerjaperiodeUpdate');
    // Route::delete('/admin/kinerja/periode/delete/{id}', 'KinerjaController@hapus')->name('kinerjaperiodeDelete');

    // Route::get('/admin/kinerja/index/{id}', 'KinerjaController@index')->name('kinerjaIndex');
    // Route::patch('/admin/kinerja/index/{id}', 'KinerjaController@create')->name('kinerjaCreate');
    // Route::get('/admin/kinerja/detail/{id}', 'KinerjaController@show')->name('kinerjaShow');
    // Route::post('/admin/kinerja/create', 'KinerjaController@store')->name('kinerjaStore');
    // Route::put('/admin/kinerja/index/{id}', 'KinerjaController@update')->name('kinerjaUpdate');
    // Route::delete('/admin/kinerja/delete/{id}', 'KinerjaController@destroy')->name('kinerjaDestroy');
    // Route::get('/laporan/cetak_kinerja', 'KinerjaController@cetak_pdf')->name('kinerjaPdf');

    Route::get('/admin/hasil/kinerja/gaji/periode/index', 'PeriodeController@hasilindex')->name('hasilperiodeIndex');
    Route::get('/admin/hasil/Gaji/index/{id}', 'KinerjaController@gajiindex')->name('hasilgajiIndex');
    Route::get('/admin/hasil/kinerja/index/{id}', 'KinerjaController@kinerjaindex')->name('hasilkinerjaIndex');
    Route::get('/admin/hasil/kinerjadetail/{periode}/{pegawai}', 'KinerjaController@kinerjadetail')->name('hasilkinerjadetailIndex');
    // Route::patch('/admin/hasil/kinerja/index/{id}', 'KinerjaController@create')->name('hasilkinerjaCreate');
    // End kinerja Perbulan


    Route::get('/admin/pegawai/index', 'karyawanController@index')->name('karyawanIndex');
    Route::get('/admin/pegawai/detail/{id}', 'karyawanController@show')->name('karyawanShow');
    Route::get('/admin/pegawai/create', 'karyawanController@create')->name('karyawanCreate');
    Route::post('/admin/pegawai/create', 'karyawanController@store')->name('karyawanStore');
    Route::get('/admin/pegawai/edit/{id}', 'karyawanController@edit')->name('karyawanEdit');
    Route::put('/admin/pegawai/edit/{id}', 'karyawanController@update')->name('karyawanUpdate');
    Route::delete('/admin/pegawai/delete/{id}', 'karyawanController@destroy')->name('karyawanDestroy');

    Route::get('/admin/absensi/index/{id}', 'AbsensiController@index')->name('absensiIndex');
    Route::get('/admin/absensi/detail/{id}', 'AbsensiController@show')->name('absensiShow');
    Route::get('/admin/absensi/create', 'AbsensiController@create')->name('absensiCreate');
    Route::post('/admin/absensi/create', 'AbsensiController@store')->name('absensiStore');
    Route::get('/admin/absensi/edit/{id}', 'AbsensiController@edit')->name('absensiEdit');
    Route::put('/admin/absensi/edit/{id}', 'AbsensiController@update')->name('absensiUpdate');
    Route::get('/admin/absensi/verifikasi/{id}', 'AbsensiController@verifikasi')->name('absensiVerifikasi');
    Route::delete('/admin/absensi/delete/{id}', 'AbsensiController@destroy')->name('absensiDestroy');

    Route::get('/admin/periode/index', 'PeriodeController@index')->name('periodeIndex');
    Route::get('/admin/periode/detail/{id}', 'PeriodeController@show')->name('periodeShow');
    Route::get('/admin/periode/create', 'PeriodeController@create')->name('periodeCreate');
    Route::post('/admin/periode/create', 'PeriodeController@store')->name('periodeStore');
    Route::get('/admin/periode/edit/{id}', 'PeriodeController@edit')->name('periodeEdit');
    Route::put('/admin/periode/edit/{id}', 'PeriodeController@update')->name('periodeUpdate');
    Route::delete('/admin/periode/delete/{id}', 'PeriodeController@destroy')->name('periodeDestroy');

    // Route::get('/admin/gaji/slip}', 'UserController@slipgaji')->name('slipgajiIndex');

    Route::get('/admin/pegawai/cetak', 'CetakController@pegawai')->name('pegawaiCetak');
    Route::get('/admin/pegawai/cetak/tanggal', 'CetakController@pegawaitgl')->name('pegawaitglCetak');
    Route::get('/admin/hasil/kinerja/cetak/bulan/{periode_id}/{periode}', 'CetakController@kinerjabulan')->name('kinerjabulanCetak');
    Route::get('/admin/hasil/gaji/cetak/bulan/{periode_id}/{periode}', 'CetakController@gajibulan')->name('gajibulanCetak');
    Route::get('/admin/hasil/gaji/cetak/slipgaji/{uuid}/{id}/{tgl}/{pegawai_id}', 'CetakController@slipgaji')->name('slipgajiCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerjapegawai/{uuid}/{id}/{tgl}/{pegawai_id}', 'CetakController@kinerjapegawai')->name('kinerjapegawaiCetak');
    Route::get('/admin/hasil/gaji/cetak/absensi/{uuid}', 'CetakController@absensi')->name('absensiCetak');
    Route::get('/admin/hasil/gaji/cetak/absensi/pegawai/{id}', 'CetakController@absensipegawai')->name('absensipegawaiCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/waktu/{id}', 'CetakController@kinerjawaktu')->name('kinerjawaktuCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/waktu/pegawai/{id}', 'CetakController@kinerjawaktupegawai')->name('kinerjawaktupegawaiCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/penyelesaian/{id}', 'CetakController@kinerjapenyelesaian')->name('kinerjapenyelesaianCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/penyelesaian/pegawai/{id}', 'CetakController@kinerjapenyelesaianpegawai')->name('kinerjapenyelesaianpegawaiCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/inisiatif/{id}', 'CetakController@kinerjainisiatif')->name('kinerjainisiatifCetak');
    Route::get('/admin/hasil/gaji/cetak/kinerja/inisiatif/pegawai/{id}', 'CetakController@kinerjainisiatifpegawai')->name('kinerjainisiatifpegawaiCetak');
});
