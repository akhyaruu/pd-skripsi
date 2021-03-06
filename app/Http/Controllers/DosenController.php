<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Chat;
use App\Models\Jadwal;
use App\Models\Proposal;
use App\Models\TugasAkhir;
use App\Models\User;
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

      $jumlahBimbingan = TugasAkhir::where('dosen_id', '=', Auth::user()->id)->count();
      $jumlahBimbinganBaru = Proposal::where('bimbingan_id', '=', null)->count();
      

      return view('dosen.bimbingan', compact('proposal', 'jumlahBimbingan', 'jumlahBimbinganBaru'));
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
      $idProposal = array();
      $cekIdProposal = Proposal::join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
         ->select('proposal.*', 'tugas_akhir.dosen_id')
         ->where('tugas_akhir.dosen_id', '=', Auth::user()->id)
         ->get();
         
      foreach ($cekIdProposal as $proposal) {
        array_push($idProposal, $proposal->id);
      }
      if (!in_array($id, $idProposal)) {
         return back();
      }


      $cekProposal = Proposal::join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
         ->select('proposal.*')
         ->where('proposal.id', '=', $id)
         ->where('tugas_akhir.dosen_id', '=', Auth::user()->id)
         ->first();
      
      if ($cekProposal->bimbingan_id == null) {
         $proposal = Proposal::join('users', 'proposal.mahasiswa_id', '=', 'users.id')
            ->join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
            ->select('proposal.*', 'users.name as mahasiswa', 'tugas_akhir.tgl_seminar', 'tugas_akhir.tgl_sidang')
            ->where('proposal.id', '=', $id)
            ->first();
         
         return view('dosen.jadwal', compact('proposal'));
         
      } else {
         $proposal = Proposal::join('users', 'proposal.mahasiswa_id', '=', 'users.id')
            ->join('tugas_akhir', 'proposal.tugas_akhir_id', '=', 'tugas_akhir.id')
            ->select('proposal.*', 'users.name as mahasiswa', 'tugas_akhir.tgl_seminar', 'tugas_akhir.tgl_sidang')
            ->where('proposal.id', '=', $id)
            ->first();

         $jadwal = Jadwal::join('bimbingan', 'jadwal.bimbingan_id', '=', 'bimbingan.id')
            ->join('proposal', 'proposal.bimbingan_id', '=', 'bimbingan.id')   
            ->select('jadwal.*')
            ->where('proposal.id', '=', $id)
            ->orderBy('jadwal.created_at', 'desc')
            ->get();

         $jumlahBimbingan = count($jadwal);

         return view('dosen.jadwal', compact('proposal', 'jadwal', 'jumlahBimbingan'));
      }
     
   }

   public function bimbinganJadwalCreate(Request $request)
   {
      $vbimbingan = $request->validate([
         'mahasiswa_id'    => 'required',
      ]);
      $vbimbingan['dosen_id'] = Auth::user()->id;
      $bimbingan = Bimbingan::create($vbimbingan);

      
      $vjadwal = $request->validate([
         'tgl_bimbingan'   => 'required',
         'judul'           => 'required',
         'catatan'         => 'required',
      ]);

      $vjadwal['bimbingan_id'] = $bimbingan->id;
      $jadwal = Jadwal::create($vjadwal);

      $proposal = Proposal::findOrFail($request->proposal_id);
      $proposal->bimbingan_id = $bimbingan->id;
      $proposal->save();

      return back()->with('success',  'Jadwal bimbingan berhasil dibuat');
   }

   public function bimbinganJadwalCreateNew(Request $request)
   {
      $validate = $request->validate([
         'bimbingan_id'    => 'required',
         'tgl_bimbingan'   => 'required',
         'judul'           => 'required',
         'catatan'         => 'required',
      ]);

      $jadwal = Jadwal::create($validate);
      return back()->with('success',  'Jadwal baru berhasil dibuat');
   }

   public function bimbinganJadwalUpdate(Request $request)
   {
      $validate = $request->validate([
         'id'              => 'required',
         'tgl_bimbingan'   => 'required',
         'judul'           => 'required',
         'catatan'         => 'required',
      ]);
      $jadwal = Jadwal::findOrFail($request->id);
      if ($request->revisi) {
         $validate['revisi'] = $request->revisi;
      } else {
         $validate['revisi'] = null;
      }
      $jadwal->update($validate);
      return back()->with('success',  'Jadwal bimbingan berhasil diperbarui');
   }

   public function bimbinganJadwalUpdateSelesai(Request $request)
   {
      $validate = $request->validate([
         'id'      => 'required',
      ]);
      $jadwal = Jadwal::findOrFail($request->id);
      $jadwal->status = 'selesai';
      $jadwal->save();
      return back()->with('success',  'Jadwal bimbingan berhasil diubah menjadi selesai');
   }

   public function bimbinganJadwalUpdateSeminar(Request $request)
   {
      $validate = $request->validate([
         'id'           => 'required',
         'tgl_seminar'  => 'required|date',
      ]);
      $jadwal = Proposal::join('tugas_akhir', 'tugas_akhir.id', '=', 'proposal.tugas_akhir_id')->select('tugas_akhir.*', 'proposal.tugas_akhir_id')
      ->where('proposal.id', '=', $request->id)->update(['tugas_akhir.tgl_seminar' => $request->tgl_seminar, 'tugas_akhir.seminar' => 'selesai']);
      return back()->with('success',  'Status seminar proposal berhasil diubah menjadi selesai');
   }
   
   public function bimbinganJadwalUpdateSidang(Request $request)
   {
      $validate = $request->validate([
         'id'           => 'required',
         'tgl_sidang'  => 'required|date',
      ]);
      $jadwal = Proposal::join('tugas_akhir', 'tugas_akhir.id', '=', 'proposal.tugas_akhir_id')->select('tugas_akhir.*', 'proposal.tugas_akhir_id')
      ->where('proposal.id', '=', $request->id)->update(['tugas_akhir.tgl_sidang' => $request->tgl_sidang, 'tugas_akhir.sidang' => 'selesai']);
      return back()->with('success',  'Status sidang proposal berhasil diubah menjadi selesai');
   }
   
   public function chat($idMhs)
   {
      $idMahasiswa = array();
      $cekIdMahasiswa = TugasAkhir::where('dosen_id', Auth::user()->id)->get();
         
      foreach ($cekIdMahasiswa as $mhs) {
        array_push($idMahasiswa, $mhs->mahasiswa_id);
      }
      if (!in_array($idMhs, $idMahasiswa)) {
         return back();
      }
      

      $mahasiswa = User::findOrFail($idMhs);
      $chat = Chat::where('dosen_id', Auth::user()->id)->where('mahasiswa_id', $idMhs)->get();
      return view('dosen.chat', compact('chat', 'mahasiswa'));
   }

   public function chatCreate(Request $request)
   {
      $validate = $request->validate([
         'isi'             => 'required',
         'mahasiswa_id'    => 'required',
      ]);

      $validate['dosen_id'] = Auth::user()->id;
      $validate['sender'] = 'dosen';
      Chat::create($validate);
      return back();
   }


}