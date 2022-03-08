@extends('layouts.admin')
@section('page','Tugas Akhir')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Pemantauan Tugas Akhir</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Dosen Pembimbing</h3>
            <p>Prof. Dr. Ahmad Imam Mawardi, MA</p>
            <!-- <p class="text-danger">belum ada dosen pembimbing</p> -->

         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Bimbingan Selanjutnya</h3>
            <p class="text-success fw-bold">12 Januari 2020</p>
            <!-- <p class="text-danger">belum ada jadwal</p> -->
            <small class="text-info" style="float: right;">cek jadwal <i class="fas fa-arrow-right"></i></small>
         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Tanggal Pengajuan</h3>
            @if ($proposal)
            <p class="fw-bold">{{ date("d-m-Y", strtotime($proposal->created_at)) }}</p>
            @else
            <p class="text-danger">belum mengajukan judul</p>
            @endif

         </div>
      </div>
   </div>

   @if($errors->any())
   <div class="alert alert-danger" role="alert">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </div>
   @elseif (session('success'))
   <div class="alert alert-success" role="alert">
      {{ session('success') }}
   </div>
   @endif


   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">

            <div class="row">
               <div class="col-md-3 divTambahProposal">
                  <h3>Judul tugas akhir</h3>
                  @if ($proposal)
                  <p class="text-danger">belum ada data tugas akhir</p>
                  @endif
                  <!-- <p class="text-info fw-bold"><i class="fas fa-history"></i> menunggu persetujuan</p> -->
                  <!-- <p class="text-success fw-bold"><i class="fas fa-check"></i> telah disetujui</p> -->
                  @if ($proposal)
                  <button class="mt-4 btn btn-warning bEdit"><i class="fas fa-pencil-alt"></i> Edit tugas
                     akhir</button>
                  @else
                  <button class="mt-4 btn btn-primary bTambah"><i class="fas fa-plus"></i> Tambah tugas
                     akhir</button>
                  @endif
               </div>
               <!-- apabila sudah ada data tugas akhir -->
               @if ($proposal)
               <div class="col-md-9 divDetailProposal">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col" class="fw-bold">Topik</th>
                           <th scope="col" class="fw-bold">Judul</th>
                           <th scope="col" class="fw-bold">Detail</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>{{ $proposal->topik }}</td>
                           <td>{{ $proposal->judul }}</td>
                           <td style="min-width:150px">
                              <button class="btn btn-primary">Abstrak</button>
                              <button class="btn btn-primary">File</button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif

               <div class="col-md-9 divFormProposal" style="display: none;">
                  <form class="formProposal" action="{{ route('tugasakhir.create') }}" method="POST">
                     @csrf
                     <div class="mb-3">
                        <label for="topikForm" class="form-label">Topik</label>
                        <input type="text" name="topik" class="form-control" id="topikForm" required>
                        <div class="form-text">Masukan topik yang akan dibahas dalam tugas akhir (ex: text
                           mining, nlp, manajemen it, dll)</div>
                     </div>
                     <div class="mb-3">
                        <label for="judulForm" class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judulForm" required>
                        <div class="form-text">Masukan judul yang sesuai dengan topik yang akan dibahas</div>
                     </div>

                     <!-- apabila sudah di acc judulnya -->
                     <!-- <div class="mb-3">
                        <label for="abstrakForm">Abstrak</label>
                        <textarea name="abstrak" class="form-control" placeholder="Masukan isi abstrak (max: 250 kata)"
                           id="abstrakForm" style="height: 230px"></textarea>
                     </div>
                     <div class="mb-3">
                        <label for="proposalForm" class="form-label">File Proposal</label>
                        <input type="file" name="file" class="form-control" id="proposalForm">
                     </div> -->
                     <!-- apabila sudah di acc judulnya -->

                     <button type="button" class="btn btn-danger text-light bClear"><i class="fas fa-eraser"></i>
                        Clear</button>
                     <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Submit</button>
                  </form>
               </div>


            </div>


         </div>
      </div>
   </div>
</div>
@endsection


@section('script')
<script>
$(document).ready(function() {
   $(".bTambah").click(function() {
      $(this).prop('disabled', true);
      $(".divFormProposal").show();
   });

   $(".bClear").click(function() {
      $('.formProposal :input').val('');
   });

});
</script>
@endsection