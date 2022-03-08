<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
   use HasFactory;
   protected $table = 'proposal';
   protected $fillable = [
      'mahasiswa_id',
      'tugas_akhir_id',
      'bimbingan_id',
      'topik',
      'judul',
      'abstrak',
      'file',
   ];
}