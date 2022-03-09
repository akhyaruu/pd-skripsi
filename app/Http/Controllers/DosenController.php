<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
   public function bimbingan() 
   {
      return view('dosen.bimbingan');
   }
}