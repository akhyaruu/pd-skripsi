<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
   use HasFactory;
   protected $table = 'tugas_akhir';

   protected $fillable = [
      'dosen_id', 'mahasiswa_id', 'seminar', 'tgl_seminar', 'sidang', 'tgl_sidang', 'status'
   ];
}