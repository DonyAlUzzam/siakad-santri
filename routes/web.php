<?php

require __DIR__ . '/../vendor/autoload.php';
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');

Route::resource('santri', \App\Http\Controllers\SantriController::class)
    ->middleware('auth');

Route::resource('siswa', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('/transaksi', \App\Http\Controllers\Management\TransaksiController::class)
->middleware('auth');

Route::resource('santri-spesifik-one', \App\Http\Controllers\SantriController::class)
    ->middleware('auth');

Route::resource('santri-mts-one', \App\Http\Controllers\Management\SiswaController::class)
    ->middleware('auth');

Route::resource('santri-mts-two', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('santri-mts-three', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('santri-ma-one', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('santri-ma-two', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('santri-ma-three', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

// Route::get('/get-data-siswa', 'Management\SiswaController@getDataSiswa');

Route::get('/changePassword','HomeController@showChangePasswordForm');

Route::group(['prefix' => 'api', 'middleware' => 'auth'],function (){
    Route::post('/get-data-siswa',                  '\App\Http\Controllers\Management\SiswaController@getDataSiswa');  
    Route::get('/get-data-siswa-all',                  '\App\Http\Controllers\SantriController@getDataSiswaAll');    
    Route::post('/get-data-pembayaran',                  '\App\Http\Controllers\Management\TransaksiController@getDataPembayaran');  
    Route::get('/rekap-total-pembayaran/{periode}',                  '\App\Http\Controllers\Management\TransaksiController@getDataTotalPembayaran');  

});