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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('soal', 'SoalController');
Route::get('soal', 'SoalController@index')->name('soal.index');
Route::get('soal/elektronika', 'SoalController@elektronika')->name('soal.elektronika');
Route::post('soal/elektronika', 'SoalController@storeElektronika')->name('soal.elektronika.store');
Route::delete('soal/elektronika/{soal}', 'SoalController@destroyElektronika')->name('soal.elektronika.destroy');
Route::get('soal/refrigration', 'SoalController@refrigration')->name('soal.refrigration');
Route::get('soal/tik', 'SoalController@tik')->name('soal.tik');
Route::get('soal/pariwisata', 'SoalController@pariwisata')->name('soal.pariwisata');
Route::resource('program', 'ProgramController');
Route::post('upload', 'UploadController@upload')->name('image.upload');
