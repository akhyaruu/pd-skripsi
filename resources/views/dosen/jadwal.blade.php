@extends('layouts.admin')
@section('page','Manajemen Jadwal')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Jadwal Bimbingan {{ $proposal->mahasiswa }}</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">

      @if (!isset($jadwal))
      <div class="card align-middle">
         <div class="card-body">
            Mahasiswa belum ada jadwal bimbingan
            <button class="btn btn-primary bBuatJadwal" style="float: right;" data-bs-toggle="modal"
               data-bs-target="#mainModal"><i class="fas fa-calendar-alt"></i>&nbsp; Buat Jadwal</button>
         </div>
      </div>
      @endif


      <script>
      let bimbinganId = '';
      </script>
      @if (isset($jadwal))

      @foreach ($jadwal as $item)
      <script>
      bimbinganId = "{{ $item->bimbingan_id }}";
      </script>
      @endforeach


      <?php $countStatus = 0; ?>
      @foreach ($jadwal as $item)
      @if ($item->status == 'selesai')
      <?php $countStatus++; ?>
      @endif
      @endforeach

      <div class="row">
         <div class="mb-3">
            <h4>Jadwal Bimbingan</h4>
            <button class="btn btn-primary bJadwalBaru" data-bs-toggle="modal" data-bs-target="#mainModal"><i
                  class=" fas fa-calendar-plus"></i> &nbsp; Jadwal Baru</button>
            <div style="float: right;">
               @if ($countStatus >= 3)
               <button class="btn btn-info text-white"><i class="fas fa-check"></i> &nbsp; Seminar Proposal</button>
               @else
               <button class="btn btn-secondary text-white" disabled><i class="fas fa-check"></i> &nbsp; Seminar
                  Proposal</button>
               @endif

               @if ($countStatus >= 6)
               <button class="btn btn-info text-white"><i class="fas fa-check"></i> &nbsp; Sidang Proposal</button>
               @else
               <button class="btn btn-secondary text-white" disabled><i class="fas fa-check"></i> &nbsp; Sidang
                  Proposal</button>
               @endif
            </div>
         </div>

         <div>
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
         </div>

         <div class="col-lg-4 col-md-4 overflow-auto" style="max-height: 400px;">
            <div class="list-group">
               <script>
               var jadwal = [];
               </script>
               @foreach ($jadwal as $item)
               <script>
               var jadwalObject = {};
               jadwalObject.id = '{{ $item->id }}';
               jadwalObject.date = '{{ $item->tgl_bimbingan }}';
               jadwalObject.judul = '{{ $item->judul }}';
               jadwalObject.catatan = '{{ $item->catatan }}';
               jadwalObject.revisi = '{{ $item->revisi }}';
               jadwal.push(jadwalObject);
               </script>
               <!-- batas 3 -->
               @if ($loop->first)
               <a href="#" class="list-group-item list-group-item-action active bJadwal" aria-current="true"
                  data-bs-toggle="modal" data-bs-target="#modalJadwal" jadwalId="{{ $item->id }}">
                  <div class="d-flex w-100 justify-content-between">
                     <h5 class="mb-1">Bimbingan baru <small>(ke-{{ $jumlahBimbingan }})</small></h5>
                     <small>{{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }}</small>
                  </div>
                  <p class="mb-1">{{ $item->judul }}</p>
               </a>
               <!-- batas 1 -->
               @if ($item->status == 'selesai')
               <button class="btn btn-secondary text-white" disabled>&nbsp; Telah Selesai</button>
               @else
               <button class="btn btn-primary bSelesai" idJadwal="{{ $item->id }}">
                  <i class="fas fa-check text-white"></i>&nbsp; Selesai</button>
               @endif
               <!-- batas 1 -->
               <hr>
               @else
               <a href="#" class="list-group-item list-group-item-action bJadwal" aria-current="true"
                  data-bs-toggle="modal" data-bs-target="#modalJadwal" jadwalId="{{ $item->id }}">
                  <div class="d-flex w-100 justify-content-between">
                     <h5 class="mb-1">Bimbingan sebelumnya </h5>
                     <small>{{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }}</small>
                  </div>
                  <p class="mb-1">{{ $item->judul }}</p>
               </a>
               <!-- batas 2 -->
               @if ($item->status == 'selesai')
               <button class="btn btn-secondary mb-3 text-white" disabled>&nbsp; Telah Selesai</button>
               @else
               <button class="btn btn-primary bSelesai mb-3" idJadwal="{{ $item->id }}">
                  <i class="fas fa-check text-white"></i>&nbsp; Selesai</button>
               @endif
               <!-- batas 2 -->
               @endif
               <!-- batas 3 -->
               @endforeach

            </div>
         </div>

         <form id="formJadwalSelesai" action="{{ route('m-bimbingan.jadwal.update.selesai') }}" class="pull-left"
            method="POST" hidden>
            @csrf
            <input id="input-id-jadwal" type="hidden" name="id" value="">
         </form>


         <div class="col-lg-8 col-md-8">

            <div class="card">
               <div class="card-body">

                  <h4 class="mb-3">Detail Proposal</h4>
                  <div>
                     <h5 class="fw-bold d-inline">Topik</h5>
                     <p>{{ $proposal->topik }}</p>
                  </div>
                  <div>
                     <h5 class="fw-bold d-inline">Judul</h5>
                     <p>{{$proposal->judul  }}</p>
                  </div>
                  <div>
                     <h5 class="fw-bold d-inline">Abstrak</h5>
                     @if (!isset($proposal->abstrak))
                     <p class="text-danger">abstrak belum ditambahkan</p>
                     @else
                     <p>{{ $proposal->abstrak }}</p>
                     @endif

                  </div>

               </div>
            </div>

         </div>
      </div>
      @endif


   </div>



   <!-- Main Modal -->
   <div class="modal fade" id="mainModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form id="formBimbingan" action="" method="POST">
               @csrf
               <input type="text" name="mahasiswa_id" value="{{ $proposal->mahasiswa_id }}" hidden>
               <input type="text" name="proposal_id" value="{{ $proposal->id }}" hidden>
               <input id="input-bimbingan-id" type="text" name="bimbingan_id" value="" hidden>
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
                        placeholder="Catatan tambahan seperti link zoom atau lainnya" style="height: 70px"
                        required></textarea>
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

   <!-- Modal Detail Jadwal -->
   <div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="exampleModalLabel">Detail Jadwal Bimbingan</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditJadwal" action="{{ route('m-bimbingan.jadwal.update') }}" method="POST">
               @csrf
               <input id="input-jadwal" type="text" name="id" value="" hidden>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="input-date-edit" class="form-label">Tanggal Bimbingan</label>
                     <input type="date" name="tgl_bimbingan" class="form-control" id="input-date-edit"
                        aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-judul-edit" class="form-label">Judul</label>
                     <input type="text" name="judul" class="form-control" id="input-judul-edit" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-catatan-edit" class="form-label">Catatan</label>
                     <textarea id="input-catatan-edit" name="catatan" class="form-control"
                        placeholder="Catatan tambahan seperti link zoom atau lainnya" style="height: 70px"
                        required></textarea>
                  </div>
                  <div class="mb-3 divRevisi" hidden>
                     <label for="input-revisi" class="form-label">Revisi</label>
                     <textarea id="input-revisi" name="revisi" class="form-control"
                        placeholder="Catatan revisi untuk mahasiswa" style="height: 120px"></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-info text-white bRevisi"><i
                        class="fas fa-clipboard-list"></i>&nbsp; Tambah Revisi</button>
                  <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-upload">
                     </i>&nbsp;Submit</button>
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

   let idJadwal = '';
   let jadwalId = '';

   $(".bClear").click(function() {
      $('#formBimbingan :input').val('');
   });

   $(".bJadwalBaru").click(function() {
      $("#formBimbingan").attr("action", "{{ route('m-bimbingan.jadwal.create.new') }}");
      $('#input-bimbingan-id').val(bimbinganId);
   });

   $(".bBuatJadwal").click(function() {
      $("#formBimbingan").attr("action", "{{ route('m-bimbingan.jadwal.create') }}");
   });

   $(".bJadwal").click(function() {

      jadwalId = $(this).attr('jadwalId');
      jadwal.forEach(element => {
         if (element.id == jadwalId) {
            $("#input-jadwal").val(element.id);
            $('#input-date-edit').val(element.date);
            $('#input-judul-edit').val(element.judul);
            $('#input-catatan-edit').val(element.catatan);

            if (element.revisi) {
               $('.divRevisi').prop("hidden", false);
               $("#input-revisi").val(element.revisi);
            } else {
               $('.divRevisi').prop("hidden", true);

            }
         }
      });


   });

   $(".bSelesai").click(function() {
      const result = confirm("Apakah kamu yakin ingin mengubah jadwal menjadi selesai?");
      if (result) {
         idJadwal = $(this).attr('idJadwal');
         jadwal.forEach(element => {
            if (element.id == idJadwal) {
               $("#input-id-jadwal").val(element.id);
            }
         });
         $('#formJadwalSelesai').submit();
      }
   });

   $(".bRevisi").click(function() {
      $(".divRevisi").prop("hidden", false);

   });


   const modalJadwal = document.getElementById('modalJadwal')
   modalJadwal.addEventListener('hidden.bs.modal', function(event) {
      $("#input-revisi").val('');

   })

});
</script>
@endsection