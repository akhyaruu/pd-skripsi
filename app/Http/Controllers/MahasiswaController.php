<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Chat;
use App\Models\Jadwal;
use App\Models\Proposal;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{

   public function tugasAkhir()
   {
      $proposal = Proposal::where('mahasiswa_id', Auth::user()->id)->first();
      $jadwal = null;
      $dosen = Proposal::join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
         ->join('users', 'tugas_akhir.dosen_id', '=', 'users.id')
         ->select('proposal.*', 'users.name as nama_dosen')
         ->where('proposal.mahasiswa_id', '=', Auth::user()->id)
         ->first();
      
      if (isset($proposal->bimbingan_id)) {
         $jadwal = Jadwal::where('bimbingan_id', $proposal->bimbingan_id)->orderBy('created_at', 'desc')->first();
      }
         
      return view('mahasiswa.tugasakhir', compact('proposal', 'dosen', 'jadwal'));
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
         'abstrak'   => 'min:10|max:2000|nullable',
         'file'      => 'mimes:pdf,doc,docx|max:1000|nullable',
      ]);

      $proposal = Proposal::findOrFail($request->id);
      $proposal->update($validate);
      return back()->with('success',  'Data tugas akhir berhasil diperbarui');
   }

   public function bimbingan()
   {
      $bimbingan = Bimbingan::where('mahasiswa_id', Auth::user()->id)->first();
      if ($bimbingan) {
         $jadwalBaru = Jadwal::where('bimbingan_id', $bimbingan->id)->orderBy('created_at', 'desc')->first();
         $jadwalLama = Jadwal::where('bimbingan_id', $bimbingan->id)->where('id', '!=', $jadwalBaru->id)->orderBy('created_at', 'desc')->get();
         return view('mahasiswa.bimbingan', compact('jadwalLama', 'jadwalBaru'));
      } else {
         return view('mahasiswa.bimbingan');
      }
   }

   public function chat()
   {
      $proposal = Proposal::where('mahasiswa_id', Auth::user()->id)->first();
      $chat = Chat::where('mahasiswa_id', Auth::user()->id)->get();
      return view('mahasiswa.chat', compact('proposal', 'chat'));
   }

   public function chatCreate(Request $request)
   {
      $validate = $request->validate([
         'isi'     => 'required',
      ]);

      $tugasAkhir = TugasAkhir::where('mahasiswa_id', Auth::user()->id)->first();
      $validate['dosen_id'] = $tugasAkhir->dosen_id;
      $validate['mahasiswa_id'] = Auth::user()->id;
      $validate['sender'] = 'mahasiswa';
      Chat::create($validate);
      return back()->with('success',  'Chat baru berhasil ditambahkan');
   }

}