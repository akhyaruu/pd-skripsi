<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
   public function user() 
   {
      $user = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
               ->select('users.*', 'roles.name as role')
               ->where('roles.name', '!=', 'Admin')->get();
      
      $dosen =  DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
               ->select('users.*', 'roles.name as role')
               ->where('roles.name', '=', 'Dosen')->count();
               
      $mhs =  DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
               ->select('users.*', 'roles.name as role')
               ->where('roles.name', '=', 'Mahasiswa')->count();
               
      return view('pages.user', compact('user', 'dosen', 'mhs'));
   }

   public function userCreate(Request $request)
   {
      $validate = $request->validate([
         'name'      => 'required|max:255',
         'role_id'   => 'required|max:1',
         'username'  => 'required|max:255',
         'email'     => 'required|max:255|unique:users,email',
         'password'  => 'required|max:255|min:4',
      ]);
      $user = User::create($validate);
      return back()->with('success',  'User ' . $user->name . ' berhasil ditambahkan');
   }

   public function userEdit(Request $request)
   {
      // $validate = $request->validate([
      //    'name'      => 'required|max:255',
      //    'role_id'   => 'required|max:1',
      //    'username'  => 'required|max:255',
      //    'email'     => 'required|max:255|unique:users,email',
      //    'password'  => 'required|max:255|min:4',
      //    'avatar'    => 'file|size:2500|dimensions:max_width=1280,min_height=720',
      // ]);
      // $user = User::create($validate);
      // return back()->with('message', 'Surat Undangan/Daftar Hadir Kegiatan Berhasil Dikirim');
   }

   public function userDestroy(Request $request) 
   {
      if (Auth::user()->id != $request->id) {
         $user = User::findOrFail($request->id);
         $user->delete();
         Session::flash('success', $user->name . ' berhasil dihapus');
     } 
     return back();
   }

  
   

   public function tugasakhir() 
   {
      return view('admin.blank');
   }
}