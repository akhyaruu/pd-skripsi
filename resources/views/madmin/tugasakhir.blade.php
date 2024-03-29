@extends('layouts.admin')
@section('page','Manajemen Tugas Akhir')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Pemantauan Tugas Akhir</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Jumlah Bimbingan</h3>
            <p class="text-success fw-bold">{{ $tugasAkhir }} Mahasiswa</p>
         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Selesai Seminar</h3>
            <p class="text-success fw-bold">{{ $seminar }} Mahasiswa</p>
         </div>
      </div>
      <div class="col-lg-4 col-md-4">
         <div class="white-box analytics-info">
            <h3 class="box-title">Selesai Sidang</h3>
            <p class="text-success fw-bold">{{ $sidang }} Mahasiswa</p>
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
            <div class="d-md-flex justify-content-between mb-3">
               <h3 class="box-title mb-0">Pengajuan Proposal Baru</h3>
            </div>
            <div class="table-responsiv">
               <table id="pengajuanTable" class="table data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border">No.</th>
                        <th class="border">Mahasiswa</th>
                        <th class="border">Topik</th>
                        <th class="border">Judul</th>
                        <th class="border">Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <script>
                     var proposal = [];
                     </script>
                     @foreach ($proposal as $item)
                     <script>
                     var proposalObject = {};
                     proposalObject.id = '{{ $item->id }}';
                     proposalObject.mahasiswaId = '{{ $item->mahasiswa_id }}';
                     proposal.push(proposalObject);
                     </script>
                     @if ($item->tugas_akhir_id == null)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="txt-oflo">{{ $item->mahasiswa }}</td>
                        <td class="txt-oflo">{{ $item->topik }}</td>
                        <td class="txt-oflo">{{ $item->judul }}</td>
                        <td class="d-flex">

                           <a class="btn btn-primary mx-1 bAssign" idProposal="{{ $item->id }}" title="Assign judul"
                              data-bs-toggle="modal" data-bs-target="#mainModal"><i class="fas fa-user-plus"></i></a>

                        </td>
                     </tr>
                     @endif
                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- dalam bimbingan -->
   <!-- <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">
            <div class="d-md-flex justify-content-between mb-3">
               <h3 class="box-title mb-0">Dalam Bimbingan</h3>
            </div>
            <div class="table-responsive">
               <table class="table no-wrap data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border">No.</th>
                        <th class="border">Nama Mahasiswa</th>
                        <th class="border">Topik</th>
                        <th class="border">Judul</th>
                        <th class="border">Dosen Pembimbing</th>
                     </tr>
                  </thead>
                  <tbody>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div> -->


   <div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="exampleModalLabel">Assign judul ke dosen</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('m-tugasakhir.assign') }}" method="POST">
               @csrf
               <div class="modal-body">
                  <select class="form-select" name="dosen_id" id="input-kategori" required>
                     <option disabled selected>--pilih dosen--</option>
                     @foreach ($user as $item)
                     @if ($item->role->name == 'Dosen')
                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               <input type="text" name="mahasiswa_id" id="input-mahasiswa" value="" required hidden>
               <input type="text" name="id_proposal" id="input-id-proposal" value="" required hidden>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> &nbsp;Assign
                     judul</button>
               </div>
            </form>
         </div>
      </div>
   </div>


</div>
@endsection

@section('script')
<script>
$(document).ready(function() {

   let idProposal = '';

   $("#pengajuanTable").on('click', '.bAssign', function() {
      idProposal = $(this).attr('idProposal');
      proposal.forEach(element => {
         if (element.id == idProposal) {
            $("#input-mahasiswa").val(element.mahasiswaId);
            $("#input-id-proposal").val(element.id);

         }
      });

   });

});
</script>
@endsection