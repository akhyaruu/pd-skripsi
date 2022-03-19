<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {
      // $visitor = Visitor::all();
      // $user = User::all();
      // return view('admin.main',compact('visitor','user'));
      // return view('pages.dashboard');
      
      if (Auth::user()->role_id == 1) {
         return redirect()->route('user');
      } elseif (Auth::user()->role_id == 2) {
         return redirect()->route('m-bimbingan');
      } else {
         return redirect()->route('tugasakhir');
      }
   }

   public function profile()
   {
      return view('admin.profile');
   }

   public function profileUpdate(Request $request)
   {
      $validate = $request->validate([
         'name'      => 'required|min:3|max:255',
         'username'  => 'required|min:3|max:255',
         'email'     => 'required|email',
      ]);

      $user = User::findOrFail(Auth::id());
      $user->update($validate);
      return back()->with('success',  'Profil berhasil diperbarui');
   }

   public function passwordUpdate(Request $request)
   {
      $request->validate([
         'current_password'      => 'required',
         'password'              => 'required',
         'password_confirmation' => 'required|same:password',
      ]);

      if (Hash::check($request->current_password, Auth::user()->password)) {
         User::findOrFail(Auth::id())->update(['password'=> Hash::make($request->password)]);
         return back()->with('success', 'Password berhasil diperbarui');
      } else {
         return back()->with('error', 'Password lama tidak sesuai');
      }


   }
 
   
  

}