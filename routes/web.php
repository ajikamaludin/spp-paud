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
Auth::routes();

Route::middleware(['auth:web'])->group(function(){
    Route::get('/', 'HomeController@index')->name('web.index');

    //Siswa
    Route::get('siswa','SiswaController@index')->name('siswa.index');
    Route::get('tambah-siswa','SiswaController@create')->name('siswa.create');
    Route::post('tambah-siswa', 'SiswaController@store')->name('siswa.store');
    Route::get('siswa/{siswa}/detail', 'SiswaController@show')->name('siswa.show');
    Route::get('siswa/{siswa}/ubah', 'SiswaController@edit')->name('siswa.edit');
    Route::post('siswa/{siswa}/ubah','SiswaController@update')->name('siswa.update');
    Route::post('siswa/{siswa}/hapus', 'SiswaController@destroy')->name('siswa.destroy');
    Route::get('import-siswa', 'SiswaController@showFormImport')->name('siswa.showimport');
    Route::post('import-siswa', 'SiswaController@import')->name('siswa.import');
    Route::get('export-siswa', 'SiswaController@export')->name('siswa.export');

    //Periode
    Route::get('periode','PeriodeController@index')->name('periode.index');
    Route::get('tambah-periode','PeriodeController@create')->name('periode.create');
    Route::post('tambah-periode', 'PeriodeController@store')->name('periode.store');
    Route::get('periode/{periode}/ubah', 'PeriodeController@edit')->name('periode.edit');
    Route::post('periode/{periode}/ubah','PeriodeController@update')->name('periode.update');
    Route::post('periode/{periode}/hapus', 'PeriodeController@destroy')->name('periode.destroy');
});



