<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
   return redirect('/login');
});


// Route::get('/blank', function () {
//    return view('admin.blank');
// })->name('blank');

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
   Route::post('/profile/update', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update');
   Route::post('/profile/password/update', [App\Http\Controllers\HomeController::class, 'passwordUpdate'])->name('password.update');
});


Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/m-user', [App\Http\Controllers\AdminController::class, 'user'])->name('user');
   Route::post('/m-user/create', [App\Http\Controllers\AdminController::class, 'userCreate'])->name('user.create');
   Route::post('/m-user/update', [App\Http\Controllers\AdminController::class, 'userUpdate'])->name('user.update');
   Route::get('/m-user/delete', [App\Http\Controllers\AdminController::class, 'userDestroy'])->name('user.destroy');
   Route::get('/m-tugasakhir', [App\Http\Controllers\AdminController::class, 'tugasakhir'])->name('m-tugasakhir');
   Route::post('/m-tugasakhir/assign', [App\Http\Controllers\AdminController::class, 'tugasakhirAssign'])->name('m-tugasakhir.assign');
});


Route::prefix('/dosen')->middleware(['auth', 'dosen'])->group(function () {
   Route::get('/m-bimbingan', [App\Http\Controllers\DosenController::class, 'bimbingan'])->name('m-bimbingan');
   Route::post('/m-bimbingan/tugasakhir/update', [App\Http\Controllers\DosenController::class, 'bimbinganUpdate'])->name('m-bimbingan.tugasakhir.update');
   Route::get('/m-bimbingan/{id}/jadwal', [App\Http\Controllers\DosenController::class, 'bimbinganJadwal'])->name('m-bimbingan.jadwal');
   Route::post('/m-bimbingan/jadwal/create', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalCreate'])->name('m-bimbingan.jadwal.create');
   Route::post('/m-bimbingan/jadwal/create/new', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalCreateNew'])->name('m-bimbingan.jadwal.create.new');
   Route::post('/m-bimbingan/jadwal/update', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalUpdate'])->name('m-bimbingan.jadwal.update');
   Route::post('/m-bimbingan/jadwal/update/selesai', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalUpdateSelesai'])->name('m-bimbingan.jadwal.update.selesai');
   Route::post('/m-bimbingan/jadwal/update/seminar', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalUpdateSeminar'])->name('m-bimbingan.jadwal.update.seminar');
   Route::post('/m-bimbingan/jadwal/update/sidang', [App\Http\Controllers\DosenController::class, 'bimbinganJadwalUpdateSidang'])->name('m-bimbingan.jadwal.update.sidang');
   Route::get('/chat/{id}/kosultasi', [App\Http\Controllers\DosenController::class, 'chat'])->name('chat.dosen');
   Route::post('/chat/kosultasi/send', [App\Http\Controllers\DosenController::class, 'chatCreate'])->name('chat.dosen.send');
});

Route::prefix('/mahasiswa')->middleware(['auth', 'mahasiswa'])->group(function () {
   Route::get('/tugasakhir', [App\Http\Controllers\MahasiswaController::class, 'tugasakhir'])->name('tugasakhir');
   Route::post('/tugasakhir/create', [App\Http\Controllers\MahasiswaController::class, 'tugasakhirCreate'])->name('tugasakhir.create');
   Route::post('/tugasakhir/update', [App\Http\Controllers\MahasiswaController::class, 'tugasakhirUpdate'])->name('tugasakhir.update');
   Route::get('/bimbingan', [App\Http\Controllers\MahasiswaController::class, 'bimbingan'])->name('bimbingan');
   Route::get('/chat/konsultasi', [App\Http\Controllers\MahasiswaController::class, 'chat'])->name('chat.mahasiswa');
   Route::post('/chat/konsultasi/send', [App\Http\Controllers\MahasiswaController::class, 'chatCreate'])->name('chat.mahasiswa.send');
   // Route::get('/download/{filename}', [App\Http\Controllers\MahasiswaController::class, 'download'])->name('download');

   Route::get('/download/{filename}', function ($filename) {
      $filePath = Storage::url('public/user/'.$filename);
    	$headers = ['Content-Type: application/pdf'];
    	$fileName = 'proposal.pdf';

    	return response()->download($filePath, $fileName, $headers);
   })->name('download');
});