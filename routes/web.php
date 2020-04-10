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


Auth::routes(['verify'	=>  true]);

Route::get('/admin', function () {
    return view('layouts.master');
})->middleware('auth', 'auth.admin')->name('dashboard');

// Route::get('/', function () {
//     return view('auth.login');
// });

// route for user page
Route::get('/find_rute', 'HomeController@page_rute');
Route::get('/booking', 'HomeController@page_booking');
Route::get('/booking/isFixed', 'HomeController@page_bookingFixed');
Route::get('/booking/all', 'HomeController@page_booking_all');
Route::get('/booking/confirm', 'HomeController@page_booking_confirm');

Route::get('/', function () {
    return view('layouts.index');
})->name('index');

// Route::get('/find_rute', function () {
//     return view('layouts.rute');
// })->name('find_rute');

// Route::get('/booking', function () {
//     return view('layouts.booking');
// })->name('booking');

// Route::get('/booking/isFixed', function () {
//     return view('layouts.verifikasi');
// })->name('verifikasi');

// Route::get('/booking/all', function () {
//     return view('layouts.check_booking');
// })->middleware('verified')->name('check_booking');

// Route::get('/booking/confirm', function(){
// 	return view('layouts.booking_confirm');
// })->name('confirm_booking');

// route for page admin
Route::middleware(['auth', 'auth.admin'])->group(function(){
	Route::get('/d_user','MasterController@page_user');
	Route::get('/d_kota','TownController@page_town');
	Route::get('/d_partner','PartnerController@page_partner');
	Route::get('/d_petugas','OfficerController@page_officer');
	Route::get('/p_bandara','BandaraController@page_bandara');
	Route::get('/p_pesawat','PesawatController@page_pesawat');
	Route::get('/k_kereta','KeretaController@page_kereta');
	Route::get('/k_stasiun','StasiunController@page_stasiun');
	Route::get('/rute', 'RuteController@page_rute');
	Route::post('/d_user','MasterController@store');
});

// coba crud ajax
Route::resource('data_user', 'MasterController');
Route::resource('data_kota', 'TownController');
Route::resource('data_petugas', 'OfficerController');
Route::resource('data_partner', 'PartnerController');
Route::resource('data_bandara', 'BandaraController');
Route::resource('data_pesawat', 'PesawatController');
Route::resource('data_kereta', 'KeretaController');
Route::resource('data_stasiun', 'StasiunController');
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
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
