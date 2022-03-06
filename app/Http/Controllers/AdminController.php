<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

   public function userDestroy(Request $request) 
   {
      $user = User::find($request->id);
      $user->delete();
      return redirect()->route('user');
   }

   public function tugasakhir() 
   {
      return view('admin.blank');
   }
}