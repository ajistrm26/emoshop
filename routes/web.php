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

Route::middleware(['guest','guest:admin'])->group( function(){
	Route::get('register/', 'RegistController@index');
	Route::post('register/save/', 'RegistController@regist_save');
	Route::get('1b063445d43ec23c0fcf4e87b1f275c7/', 'RegistController@admregist');
	Route::post('register/saveadm/', 'RegistController@admregist_save');
	Route::get('login/','Auth\LoginController@index');
	Route::post('login/', 'Auth\LoginController@login');
	Route::get('login/admin', 'Auth\AdminLoginController@index');
	Route::post('login/admin', 'Auth\AdminLoginController@login');
	Route::get('/', 'CustController@one');
	Route::get('beli/', 'CustController@checkbuy');
});

Route::middleware(['auth:admin','ifadmin'])->group( function() {
	Route::get('admin/','AdminController@index');
	Route::get('admin/logout/', 'Auth\AdminLoginController@logout');

	Route::get('merk/', 'AdminController@merk');
	Route::get('merk/add', 'AdminController@merk_add');
	Route::post('merk/save', 'AdminController@merk_save');
	Route::get('merk/{id}/edit', 'AdminController@merk_edit');
	Route::patch('merk/{id}/update', 'AdminController@merk_update');
	Route::delete('merk/{id}/delete', 'AdminController@merk_destroy');

	Route::get('barang/', 'AdminController@barang');
	Route::get('barang/add', 'AdminController@barang_add');
	Route::post('barang/save', 'AdminController@barang_save');
	Route::get('barang/{id}/edit', 'AdminController@barang_edit');
	Route::patch('barang/{id}/update', 'AdminController@barang_update');
	Route::delete('barang/{id}/delete', 'AdminController@barang_destroy');
	Route::post('barang/search', 'AdminController@cari');

	Route::get('penjualan/', 'AdminController@penjualan');
	Route::get('penjualan/{id}/detail', 'AdminController@penjualan_detail');
});

Route::middleware(['auth','ifcust'])->group( function() {
	Route::get('cust/','CustController@index');
	Route::get('logout/', 'Auth\LoginController@logout');
	Route::get('cart/', 'CustController@cart');
	Route::get('beli/form', 'CustController@beli_form');
	Route::post('beli/save', 'CustController@beli_save');
	Route::delete('beli/{id}/delete', 'CustController@beli_destroy');
	Route::get('pembelian/', 'CustController@pembelian');
	Route::get('pembelian/{id}/detail', 'CustController@detail_pembelian');
	Route::post('barang/cari', 'CustController@cari');
});