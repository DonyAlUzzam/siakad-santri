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
    if(Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/detail-pembayaran-ma/{nim}', [App\Http\Controllers\PembayaranController::class, 'detail'])->name('detail')->middleware('auth');

Route::get('/detail-pembayaran-mts/{nim}', [App\Http\Controllers\Management\TransaksiController::class, 'detail'])->name('detail')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');

Route::resource('santri', \App\Http\Controllers\SantriController::class)
    ->middleware('auth');

Route::resource('siswa', \App\Http\Controllers\Management\SiswaController::class)
->middleware('auth');

Route::resource('/transaksi-mts', \App\Http\Controllers\Management\TransaksiController::class)
->middleware('auth');

Route::resource('/transaksi-ma', \App\Http\Controllers\PembayaranController::class)
->middleware('auth');

// Route::resource('santri-spesifik-one', \App\Http\Controllers\SantriController::class)
//     ->middleware('auth');

Route::resource('santri-mts', \App\Http\Controllers\SantriController::class)
    ->middleware('auth');

Route::resource('santri-ma', \App\Http\Controllers\Management\SiswaController::class)
    ->middleware('auth');

// Route::resource('santri-mts-two', \App\Http\Controllers\Management\SantriController::class)
// ->middleware('auth');

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
    Route::post('/get-data-siswa-mts',                  '\App\Http\Controllers\SantriController@getDataSiswa');  
    Route::post('/get-data-siswa-ma',                  '\App\Http\Controllers\Management\SiswaController@getDataSiswa');  
    Route::get('/get-data-siswa-all',                  '\App\Http\Controllers\SantriController@getDataSiswaAll');    
    Route::post('/get-data-pembayaran',                  '\App\Http\Controllers\Management\TransaksiController@getDataPembayaran');  
    Route::post('/get-detail-pembayaran/{nim}',                  '\App\Http\Controllers\Management\TransaksiController@getDataDetailPembayaran');  

    Route::post('/get-data-pembayaran-ma',                  '\App\Http\Controllers\PembayaranController@getDataPembayaran');  
    Route::post('/get-detail-pembayaran-ma/{nim}',                  '\App\Http\Controllers\PembayaranController@getDataDetailPembayaran');  

    Route::post('/rekap-total-pembayaran',                  '\App\Http\Controllers\Management\TransaksiController@getDataTotalPembayaran');  
    Route::post('/rekap-total-detail-pembayaran/{nim}',                  '\App\Http\Controllers\Management\TransaksiController@getDataTotalDetailPembayaran');  

    Route::post('/rekap-total-pembayaran-ma',                  '\App\Http\Controllers\PembayaranController@getDataTotalPembayaran');  

    Route::post('/rekap-total-detail-pembayaran-ma/{nim}',                  '\App\Http\Controllers\PembayaranController@getDataTotalDetailPembayaran');  

    Route::post('/get-data-pembayaran-all',                  'App\Http\Controllers\HomeController@getDataPembayaranAll');  
    Route::post('/get-data-rekap-pembayaran-all',                  'App\Http\Controllers\HomeController@getDataRekapPembayaranAll');  

});