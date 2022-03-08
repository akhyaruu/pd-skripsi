<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{

   public function tugasAkhir()
   {
      $proposal = Proposal::where('mahasiswa_id', Auth::user()->id)->first();
      return view('mahasiswa.tugasakhir', compact('proposal'));
   }

   public function bimbingan()
   {
      return view('mahasiswa.bimbingan');
   }

   public function tugasakhirCreate(Request $request) 
   {
      $validate = $request->validate([
         'topik'  => 'required|min:3|max:255',
         'judul'  => 'required|min:3|max:255',
      ]);
      
      $validate['mahasiswa_id'] = Auth::user()->id;
      Proposal::create($validate);
      return back()->with('success',  'Data tugas akhir baru berhasil ditambahkan');
   }

   public function tugasakhirUpdate(Request $request) 
   {
      $validate = $request->validate([
         'topik'     => 'required|min:3|max:255',
         'judul'     => 'required|min:3|max:255',
         'abstrak'   => 'min:10|max:255',
         'file'      => 'mimes:pdf,doc,docx|max:1000',
      ]);

      $proposal = Proposal::findOrFail($request->id);
      $proposal->update($validate);
      return back()->with('success',  'Data tugas akhir berhasil diubah');
   }

   
}