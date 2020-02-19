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

// route for page
Route::get('/d_user','MasterController@page_user');
Route::get('/d_kota','TownController@page_town');
Route::get('/d_partner','PartnerController@page_partner');
Route::get('/d_petugas','OfficerController@page_officer');
Route::get('/p_bandara','BandaraController@page_bandara');
Route::get('/p_pesawat','PesawatController@page_pesawat');
Route::get('/rute', 'RuteController@page_rute');
Route::post('/d_user','MasterController@store');

// coba crud ajax
Route::resource('data_user', 'MasterController');
Route::resource('data_kota', 'TownController');
Route::resource('data_petugas', 'OfficerController');
Route::resource('data_partner', 'PartnerController');
Route::resource('data_bandara', 'BandaraController');
Route::resource('data_pesawat', 'PesawatController');
Route::resource('rute_pesawat', 'RuteController');
// Route::get('ajax_crud','AjaxController@index');

// data dummy

Route::get('/create_airport', function(){
	$town = App\Town::findOrFail(1);

	$town->airports()->create([
		'nama_bandara' => 'yy',
		'kota'	=> 'surabaya',
		'kode'	=> 'dsdsa12',
		'status' => 'aktif'
	]);

	return 'success';
});

Route::get('/read_airport', function(){
	$town = App\Town::findOrFail(1);

	$airports = $town->airports()->get();

	foreach ($airports as $airport) {
		$data[] = [
			'nama_bandara' => $airport->nama_bandara,
			'town_id' => $airport->town_id,
			'kota' => $airport->kota,
			'kode' => $airport->kode,
			'status' => $airport->status
		];
	}

	return $data;
});

Route::get('/update_airport', function(){
	$town = App\Town::findOrFail(1);

	$town->airports()->where('id', 3)->update([
		'nama_bandara' => 'bandara anjay',
		'kota' => 'kota anjay',
		'kode' => 'kode anjay',
		'status' =>  'aktif'
	]);	

	return 'success';
});

Route::get('/delete_airport', function(){
	$town = App\Town::find(1);

	$town->airports()->whereId(1)->delete();

	return 'Success';
});