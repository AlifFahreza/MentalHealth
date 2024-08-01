<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
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
    return view('landing-page');
});

Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::post('contactUs', [MahasiswaController::class, 'contactUs'])
        ->name('contactUs');

Route::get('landing-page', [MahasiswaController::class, 'landingPage'])
        ->name('landing-page');

Route::get('/sign-up', [AuthController::class, 'signUp'])
        ->name('sign-up');

Route::post('register', [AuthController::class, 'register'])
        ->name('register');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
    	/*
    		Route Khusus untuk role admin
    	*/
        Route::get('admin', [AdminController::class, 'index'])
            ->name('admin');
    });
    Route::group(['middleware' => ['cek_login:mahasiswa']], function () {
    	/*
    		Route Khusus untuk role Mahasiswa
    	*/
            Route::get('mahasiswa', [MahasiswaController::class, 'index'])
            ->name('mahasiswa');
    });
    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout');

//Admin
Route::get('admin', [AdminController::class, 'index'])
        ->name('admin');
Route::get('kelola-users', [AdminController::class, 'pageKelolaUsers'])
        ->name('kelola-users');
Route::get('input-psikolog', [AdminController::class, 'pageInputPsikolog'])
        ->name('input-psikolog');
Route::get('kelola-psikolog', [AdminController::class, 'pageKelolaPsikolog'])
        ->name('kelola-psikolog');
Route::get('kelola-artikel', [AdminController::class, 'pageKelolaArtikel'])
        ->name('kelola-artikel');
Route::get('kelola-konsultasi', [AdminController::class, 'pageKelolaKonsultasi'])
        ->name('kelola-konsultasi');
Route::get('showProfile', [AdminController::class, 'showProfile'])
        ->name('showProfile');
Route::get('admin/insertUser', [AdminController::class, 'insertUser'])
        ->name('admin.insertUser');
Route::post('admin/storeUser', [AdminController::class, 'storeUser'])
        ->name('admin.storeUser');
Route::get('/mahasiswa/{mahasiswa}', [AdminController::class, 'showUser'])
        ->name('admin.showUser');
Route::delete('mahasiswa/{mahasiswa}', [AdminController::class, 'destroyUser'])
        ->name('admin.destroyUser');
Route::patch('/mahasiswa/{mahasiswa}', [AdminController::class, 'updateUser'])
        ->name('admin.updateUser');
Route::get('/mahasiswa/{mahasiswa}/edit', [AdminController::class, 'editUser'])
        ->name('admin.editUser');
Route::post('admin/storePsikolog', [AdminController::class, 'storePsikolog'])
        ->name('admin.storePsikolog');
Route::get('/psikolog/{psikolog}', [AdminController::class, 'showPsikolog'])
        ->name('admin.showPsikolog');
Route::delete('psikolog/{psikolog}', [AdminController::class, 'destroyPsikolog'])
        ->name('admin.destroyPsikolog');
Route::post('admin/storeArtikel', [AdminController::class, 'storeArtikel'])
        ->name('admin.storeArtikel');
Route::get('input-Artikel', [AdminController::class, 'pageInputArtikel'])
        ->name('input-Artikel');
Route::get('/artikel/{artikel}', [AdminController::class, 'showArtikel'])
        ->name('admin.showArtikel');
Route::get('/artikel/{artikel}/edit', [AdminController::class, 'editArtikel'])
        ->name('admin.editArtikel');
Route::patch('/artikel/{artikel}', [AdminController::class, 'updateArtikel'])
        ->name('admin.updateArtikel');
Route::delete('artikel/{artikel}', [AdminController::class, 'destroyArtikel'])
        ->name('admin.destroyArtikel');
Route::get('admin/insertVideo', [AdminController::class, 'insertVideo'])
        ->name('admin.insertVideo');
Route::post('admin/storeVideo', [AdminController::class, 'storeVideo'])
        ->name('admin.storeVideo');
Route::delete('video/{video}', [AdminController::class, 'destroyVideo'])
        ->name('admin.destroyVideo');
Route::get('/video/{video}/edit', [AdminController::class, 'editVideo'])
        ->name('admin.editVideo');
Route::patch('/video/{video}', [AdminController::class, 'updateVideo'])
        ->name('admin.updateVideo');
Route::get('/video/{video}', [AdminController::class, 'showVideo'])
        ->name('admin.showVideo');

//USER MAHASISWA
Route::get('homeUser', [MahasiswaController::class, 'index'])
        ->name('homeUser');
Route::get('konsultasiUser', [MahasiswaController::class, 'konsultasiUser'])
        ->name('konsultasiUser');
Route::get('videoMentalHealth', [MahasiswaController::class, 'videoMentalHealth'])
        ->name('videoMentalHealth');

// Route::patch('/psikolog/{psikolog}', [AdminController::class, 'updatePsikolog'])
//         ->name('admin.updatePsikolog');
// Route::get('/psikolog/{psikolog}/edit', [AdminController::class, 'editPsikolog'])
//         ->name('admin.editPsikolog');
});