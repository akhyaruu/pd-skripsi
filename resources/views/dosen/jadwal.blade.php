@extends('layouts.admin')
@section('page','Manajemen Jadwal')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Jadwal Bimbingan {{ $proposal->mahasiswa }}</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">

      <div class="card align-middle">
         <div class="card-body">
            Mahasiswa belum ada jadwal bimbingan
            <button class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#mainModal">
               <i class="fas fa-calendar-alt"></i>&nbsp; Buat Jadwal</button>
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
   <!-- Modal -->
   <div class="modal fade" id="mainModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="formBimbingan" action="{{ route('m-bimbingan.jadwal.create') }}" method="POST">
               @csrf
               <input type="text" name="mahasiswa_id" value="{{ $proposal->mahasiswa_id }}" hidden>
               <input type="text" name="proposal_id" value="{{ $proposal->id }}" hidden>
               <div class="modal-header">
                  <h5 class="modal-title fw-bold">Atur Jadwal Bimbingan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="input-date" class="form-label">Tanggal Bimbingan</label>
                     <input type="date" name="tgl_bimbingan" class="form-control" id="input-date"
                        aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-judul" class="form-label">Judul</label>
                     <input type="text" name="judul" class="form-control" id="input-judul" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-catatan" class="form-label">Catatan</label>
                     <textarea name="catatan" class="form-control"
                        placeholder="Catatan tambahan seperti link zoom atau lainnya" id="abstrakForm"
                        style="height: 120px" required></textarea>

                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger text-light bClear"><i class="fas fa-eraser"></i>
                     Clear</button>
                  <button type="submit" class="btn btn-primary bSubmit"><i class="fas fa-upload"></i>&nbsp;
                     Submit</button>
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


   $(".bClear").click(function() {
      $('#formBimbingan :input').val('');
   });


});
</script>
@endsection