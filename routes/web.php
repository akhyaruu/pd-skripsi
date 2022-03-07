<?php

use App\Models\User;
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
   // echo Form::select('size', ['L' => 'Large', 'S' => 'Small'], 'S');
   // $data = User::all();
   // return view('coba', compact('data'));
});


Route::get('/blank', function () {
   return view('admin.blank');
})->name('blank');

Auth::routes();

// Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
// Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
// Route::put('/profile/password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
// Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
// Route::resource('post',App\Http\Controllers\PostController::class);
// Route::resource('post',App\Http\Controllers\PostController::class);


// Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen');
// Route::get('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa');
// Route::get('/tugasakhir', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('tugasakhir');
// Route::get('/bimbingan', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('bimbingan');


Route::middleware(['auth'])->group(function () {
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});


Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/m-user', [App\Http\Controllers\AdminController::class, 'user'])->name('user');
   Route::post('/m-user/create', [App\Http\Controllers\AdminController::class, 'userCreate'])->name('user.create');
   Route::post('/m-user/edit', [App\Http\Controllers\AdminController::class, 'userEdit'])->name('user.edit');
   Route::get('/m-user/delete', [App\Http\Controllers\AdminController::class, 'userDestroy'])->name('user.destroy');
   Route::get('/tugas-akhir', [App\Http\Controllers\AdminController::class, 'tugasakhir'])->name('tugasakhir');
});





// Route::prefix('/dosen')->middleware(['auth', 'dosen'])->group(function () {
//    Route::get('/tugasakhir', [App\Http\Controllers\HomeController::class, 'tugasakhir'])->name('tugasakhir');
//    Route::get('/bimbingan', [App\Http\Controllers\HomeController::class, 'bimbingan'])->name('bimbingan');
// });

// Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->group(function () {
//    Route::get('/tugasakhir', [App\Http\Controllers\HomeController::class, 'tugasakhir'])->name('tugasakhir');
//    Route::get('/bimbingan', [App\Http\Controllers\HomeController::class, 'bimbingan'])->name('bimbingan');
// });