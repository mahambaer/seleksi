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
Route::post('soal/refrigration', 'SoalController@storeRefrigration')->name('soal.refrigration.store');
Route::delete('soal/refrigration/{soal}', 'SoalController@destroyRefrigration')->name('soal.refrigration.destroy');
Route::get('soal/tik', 'SoalController@tik')->name('soal.tik');
Route::post('soal/tik', 'SoalController@storeTik')->name('soal.tik.store');
Route::delete('soal/tik/{soal}', 'SoalController@destroyTik')->name('soal.tik.destroy');
Route::get('soal/pariwisata', 'SoalController@pariwisata')->name('soal.pariwisata');
Route::post('soal/pariwisata', 'SoalController@storePariwisata')->name('soal.pariwisata.store');
Route::delete('soal/pariwisata/{soal}', 'SoalController@destroyPariwisata')->name('soal.pariwisata.destroy');
Route::resource('program', 'ProgramController');
Route::resource('peserta', 'PesertaController');
Route::post('peserta/send', 'PesertaController@tokenLinkSendRequest')->name('peserta.send');
Route::post('peserta/import', 'PesertaController@importExcel')->name('peserta.import');
Route::post('upload', 'UploadController@upload')->name('image.upload');
//Route::get('seleksi/{token}', 'SeleksiController@showSeleksi')->name('seleksi');
Route::get('seleksi', 'SeleksiController@index')->name('landing');
Route::get('seleksi/{email}', 'SeleksiController@showSeleksi')->name('seleksi');
Route::post('seleksi', 'SeleksiController@confirmEmail')->name('confirm');
// Route::get('seleksi', function(){
//     return view('seleksi')->with('peserta');
// });
//Route::get('mulai/{token}', 'SeleksiController@showMulai')->name('mulai');
Route::get('mulai/{email}', 'SeleksiController@showMulai')->name('mulai');
Route::post('getscore/{jawaban}', 'AjaxController@getScore')->name('getscore');
Route::post('sendscore/{peserta}', 'AjaxController@sendScore')->name('sendscore');
