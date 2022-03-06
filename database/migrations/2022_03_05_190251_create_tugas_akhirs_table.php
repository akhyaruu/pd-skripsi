<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasAkhirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('users');
            $table->foreignId('mahasiswa_id')->constrained('users');
            $table->string('seminar')->nullable();
            $table->date('tgl_seminar')->nullable();
            $table->string('sidang')->nullable();
            $table->date('tgl_sidang')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas_akhirs');
    }
}