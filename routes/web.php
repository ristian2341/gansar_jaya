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
    return view('layout');
});

Route::get('layout',function () {
    return view('layout');
})->name('layout');

Route::post('login','LoginController@login')->name('postlogin');
Route::get('logout','LoginController@logout')->name('logout');

/// user //
Route::get('user','UserController@index')->name('users');
Route::get('user/form','UserController@add_user')->name('form_user');
Route::post('user/form','UserController@add_user')->name('simpan_user');
Route::get('user/form_update/{id}','UserController@update_user')->name('user_update');
Route::post('user/form_update/{id}','UserController@update_user')->name('update_user');
Route::get('user/delete_user/{id}','UserController@delete_user')->name('delete');


// kondisi barang //
Route::get('kondisi','KondisiController@index')->name('kondisi');
Route::get('kondisi/form','KondisiController@add_data')->name('form_kondisi');
Route::post('kondisi/form','KondisiController@add_data')->name('simpan_kondisi');
Route::get('kondisi/form_update/{id}','KondisiController@update')->name('kondisi_update');
Route::post('kondisi/form_update/{id}','KondisiController@update')->name('update_kondisi');
Route::get('kondisi/delete_kondisi/{id}','KondisiController@delete')->name('delete_kondisi');

// kategori barang //
Route::get('kategori','KategoriController@index')->name('kategori');
Route::get('kategori/form','KategoriController@add_data')->name('form_kategori');
Route::post('kategori/form','KategoriController@add_data')->name('simpan_kategori');
Route::get('kategori/form_update/{id}','KategoriController@update')->name('kategori_update');
Route::post('kategori/form_update/{id}','KategoriController@update')->name('update_kategori');
Route::get('kategori/delete_kategori/{id}','KategoriController@delete')->name('delete_kategori');

// barang //
Route::get('barang','BarangController@index')->name('barang');
Route::get('barang/form','BarangController@add_data')->name('form_barang');
Route::post('barang/form','BarangController@add_data')->name('simpan_barang');
Route::get('barang/form_update/{id}','BarangController@update')->name('barang_update');
Route::post('barang/form_update/{id}','BarangController@update')->name('update_barang');
Route::get('barang/delete_barang/{id}','BarangController@delete')->name('delete_barang');
Route::get('/export-barang','BarangController@export_barang')->name('excel_barang');

// Pinjam //
Route::get('pinjam','PinjamController@index')->name('pinjam');
Route::get('pinjam/form','PinjamController@add_data')->name('form_pinjam');
Route::post('pinjam/form','PinjamController@add_data')->name('simpan_pinjam');
Route::get('pinjam/form_update/{id}','PinjamController@update')->name('pinjam_update');
Route::post('pinjam/form_update/{id}','PinjamController@update')->name('update_pinjam');
Route::get('pinjam/delete_pinjam/{id}','PinjamController@delete')->name('delete_pinjam');
Route::get('pinjam/approve_pinjam/{id}','PinjamController@approve')->name('approve_pinjam');
Route::get('pinjam/view_pinjam/{id}','PinjamController@view')->name('view_pinjam');

// Pinjam //
Route::get('pengembalian','PengembalianController@index')->name('pengembalian');
Route::get('pengembalian/form','PengembalianController@add_data')->name('form_pengembalian');
Route::post('pengembalian/form','PengembalianController@add_data')->name('simpan_pengembalian');
Route::get('pengembalian/form_update/{id}','PengembalianController@update')->name('pengembalian_update');
Route::post('pengembalian/form_update/{id}','PengembalianController@update')->name('update_pengembalian');
Route::get('pengembalian/delete_pengembalian/{id}','PengembalianController@delete')->name('delete_pengembalian');
Route::get('pengembalian/approve_pengembalian/{id}','PengembalianController@approve')->name('approve_pengembalian');
Route::get('pengembalian/view_pengembalian/{id}','PengembalianController@view')->name('view_pengembalian');
Route::post('pengembalian/data_detail','PengembalianController@detail_pinjam')->name('detailpinjam');

// route laporan barang rusak-hilang//
Route::get('lapbarang','LapBarangController@index')->name('lap_barang');
Route::get('lapbarang/form','LapBarangController@add_data')->name('form_lap_barang');
Route::post('lapbarang/form','LapBarangController@add_data')->name('simpan_laporan');
Route::get('lapbarang/approve_lapbarang/{id}','LapBarangController@approve')->name('approve_lapbarang');
Route::get('lapbarang/view_lapbarang/{id}','LapBarangController@view')->name('view_lapbarang');
Route::get('lapbarang/lapbarang_update/{id}','LapBarangController@update')->name('lapbarang_update');
Route::post('lapbarang/lapbarang_update/{id}','LapBarangController@update')->name('update_laporan');
Route::get('lapbarang/lapbarang_delete/{id}','LapBarangController@delete')->name('lapbarang_delete');