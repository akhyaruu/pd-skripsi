<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Jadwal;
use App\Models\Proposal;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
   public function bimbingan() 
   {
      $proposal = TugasAkhir::join('proposal', 'tugas_akhir.id', '=', 'proposal.tugas_akhir_id')
                  ->join('users', 'proposal.mahasiswa_id', '=', 'users.id')
                  ->select('proposal.*', 'users.name as mahasiswa')
                  ->orderBy('proposal.updated_at', 'desc')
                  ->where('tugas_akhir.dosen_id', '=', Auth::user()->id)
                  ->get();
      return view('dosen.bimbingan', compact('proposal'));
   }

   public function bimbinganUpdate(Request $request) 
   {
      $validate = $request->validate([
         'id'     => 'required',
         'topik'     => 'required|min:3|max:255',
         'judul'     => 'required|min:3|max:255',
      ]);

      $proposal = Proposal::findOrFail($request->id);
      $proposal->update($validate);
      return back()->with('success',  'Data tugas akhir berhasil diperbarui');
   }

   public function bimbinganJadwal($id)
   {
      try {
         $cekProposal = Proposal::join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
                     ->select('proposal.*')
                     ->where('proposal.id', '=', $id)
                     ->where('tugas_akhir.dosen_id', '=', Auth::user()->id)
                     ->first();
         
         if ($cekProposal->bimbingan == null) {
            $proposal = Proposal::join('users', 'proposal.mahasiswa_id', '=', 'users.id')
                        ->select('proposal.*', 'users.name as mahasiswa')
                        ->where('proposal.id', '=', $id)
                        ->first();
   
            return view('dosen.jadwal', compact('proposal'));
            
         } else {
            // $proposal = Proposal::join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
            //             ->join('users', 'proposal.mahasiswa_id', '=', 'users.id')
            //             ->select('proposal.*', 'users.name as mahasiswa')
            //             ->where('proposal.id', '=', $id)
            //             ->where('tugas_akhir.dosen_id', '=', Auth::user()->id)
            //             ->first();
   
            $proposal = Proposal::join('users', 'proposal.mahasiswa_id', '=', 'users.id')
                        ->select('proposal.*', 'users.name as mahasiswa')
                        ->where('proposal.id', '=', $id)
                        ->first();
   
            $bimbingan = Jadwal::join('bimbingan', 'jadwal.bimbingan_id', '=', 'bimbingan.id')
                        ->select('proposal.*', 'users.name as mahasiswa')
                        ->where('proposal.id', '=', $id)
                        ->get();
   
            return view('dosen.jadwal', compact('proposal', 'bimbingan'));
         }
      } catch (\Throwable $th) {
         return back();
      }
   }

   public function bimbinganJadwalCreate(Request $request)
   {
      $validate = $request->validate([
         'mahasiswa_id'    => 'required',
         'proposal_id'     => 'required',
         'tgl_bimbingan'   => 'required|date',
         'judul'           => 'required|min:3|max:255',
         'catatan'         => 'required|min:3|max:255',
      ]);

      $bimbingan = Bimbingan::
   }

}