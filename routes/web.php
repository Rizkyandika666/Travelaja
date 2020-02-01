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

Route::get('/admin', function () {
    return view('layouts.master');
});

Route::get('/d_user','MasterController@page_user');
Route::get('/d_kota','TownController@page_town');
Route::get('/d_partner','PartnerController@page_partner');
Route::get('/d_petugas','OfficerController@page_officer');
Route::get('/p_bandara','BandaraController@page_bandara');
Route::get('/ajax_crud','AjaxController@contoh_ajax');
Route::get('/ajax_product','AjaxController@v_product');
Route::post('/d_user','MasterController@store');

// coba crud ajax
Route::resource('ajax_crud','AjaxController');
Route::resource('ajaxproducts', 'ProductAjaxController');
Route::resource('data_user', 'MasterController');
Route::resource('data_kota', 'TownController');
Route::resource('data_petugas', 'OfficerController');
Route::resource('data_partner', 'PartnerController');
Route::resource('data_bandara', 'BandaraController');
// Route::get('ajax_crud','AjaxController@index');