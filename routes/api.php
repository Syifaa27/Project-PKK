<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');

Route::post('data_barang', 'DataBarangController@store')->middleware('jwt.verify');
Route::put('data_edit/{id}', 'DataBarangController@update')->middleware('jwt.verify');
Route::get('tampil_data', 'DataBarangController@tampil')->middleware('jwt.verify');
Route::delete('hapus_data/{id}', 'DataBarangController@destroy')->middleware('jwt.verify');

Route::post('penyewa', 'PenyewaController@store')->middleware('jwt.verify');
Route::put('penyewa_edit/{id}', 'PenyewaController@update')->middleware('jwt.verify');
Route::get('tampil_penyewa', 'PenyewaController@tampil')->middleware('jwt.verify');
Route::delete('hapus_penyewa/{id}', 'PenyewaController@destroy')->middleware('jwt.verify');

Route::post('detail_sewa', 'DetailSewaController@store')->middleware('jwt.verify');
Route::put('detail_edit/{id}', 'DetailSewaController@update')->middleware('jwt.verify');
Route::get('tampil_detail', 'DetailSewaController@tampil')->middleware('jwt.verify');
Route::delete('hapus_detail/{id}', 'DetailSewaController@destroy')->middleware('jwt.verify');

Route::post('sewa', 'SewaController@store')->middleware('jwt.verify');
Route::put('sewa_edit/{id}', 'SewaController@update')->middleware('jwt.verify');
Route::get('tampil_sewa', 'SewaController@tampil')->middleware('jwt.verify');
Route::delete('hapus_sewa/{id}', 'SewaController@destroy')->middleware('jwt.verify');