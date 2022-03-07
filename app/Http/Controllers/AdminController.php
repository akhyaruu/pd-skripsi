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

   public function userUpdate(Request $request)
   {
      $validate = $request->validate([
         'name'      => 'required|max:255',
         'role_id'   => 'required|max:1',
         'username'  => 'required|max:255',
         'email'     => 'required|max:255',
      ]);
      $user = User::findOrFail($request->id);
      $user->update($validate);
      return back()->with('success',  'User ' . $user->name . ' berhasil diubah');
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