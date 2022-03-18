@extends('layouts.admin')
@section('page','Jadwal Bimbingan')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Detail Bimbingan</a></li>
@endsection

@section('content')
<div class="container-fluid">

   <div class="row">


      @if (!isset($jadwalBaru))
      <div class="alert alert-info" role="alert">
         Belum ada jadwal bimbingan
      </div>
      @else
      <div class="col-lg-4 col-md-4">
         <div class="card">
            <div class="card-body">
               @if ($jadwalBaru->status == 'selesai')
               <h5 class="fw-bold mb-2">Bimbingan Selanjutnya - <span class="text-success">selesai</span></h5>
               <hr>
               <h5 class="card-title fw-bold">Judul:</h5>
               <p class="card-title">{{ $jadwalBaru->judul }}</p>
               <h5 class="card-title fw-bold mt-3">Catatan:</h5>
               <p class="card-text">{{ $jadwalBaru->catatan }}</p>
               <!-- spesial revisi -->
               @if ($jadwalBaru->revisi)
               <h5 class="card-title fw-bold">Revisi:</h5>
               <p class="card-title">{{ $jadwalBaru->revisi }}</p>
               @endif
               <!-- spesial revisi -->
               @else
               <h5 class="fw-bold mb-2">Bimbingan Selanjutnya</h5>
               <span id="dateJadwalBaru" class="fs-3">{{ date("d-m-Y", strtotime($jadwalBaru->tgl_bimbingan)) }}</span>
               <span style="float: right;"
                  class="fw-bold fs-3">{{ date_diff( date_create(date("d-m-Y", strtotime($jadwalBaru->tgl_bimbingan))) , date_create(date("d-m-Y"))    )->format("%R%a hari lagi") }}</span>
               <hr>
               <h5 class="card-title fw-bold">Judul:</h5>
               <p class="card-title">{{ $jadwalBaru->judul }}</p>
               <h5 class="card-title fw-bold mt-3">Catatan:</h5>
               <p class="card-text">{{ $jadwalBaru->catatan }}</p>
               <!-- spesial revisi -->
               @if ($jadwalBaru->revisi)
               <h5 class="card-title fw-bold">Revisi:</h5>
               <p class="card-title">{{ $jadwalBaru->revisi }}</p>
               @endif
               <!-- spesial revisi -->
               @endif
            </div>
         </div>

      </div>




      <div class="col-lg-8 col-md-8">
         <div class="white-box">
            <h5 class="fw-bold mb-4">Bimbingan Sebelumnya</h5>
            @if (count($jadwalLama) >= 1)
            <hr>
            <div class="accordion" id="accordionExample">
               @foreach($jadwalLama as $item)
               @if ($loop->first)
               <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @if ($item->status == 'selesai')
                        Bimbingan {{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }} &nbsp - <span
                           class="fw-bold text-success">&nbsp
                           {{ $item->status }}</span>
                        @else
                        Bimbingan {{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }}
                        @endif
                     </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                     data-bs-parent="#accordionExample">
                     <div class="accordion-body">
                        <span class="fw-bold d-block">Judul:</span>
                        {{ $item->judul }}
                        <span class="fw-bold mt-3 d-block">Catatan:</span>
                        {{ $item->catatan }}
                        @if (isset($item->revisi))
                        <span class="fw-bold mt-3 d-block">Revisi:</span>
                        {{ $item->revisi }}
                        @else
                        <span class="fw-bold mt-3 d-block">Revisi:</span>
                        -
                        @endif
                     </div>
                  </div>
               </div>
               @else
               <div class="accordion-item">
                  <h2 class="accordion-header">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#bimbingan{{ $loop->iteration }}" aria-expanded="false"
                        aria-controls="bimbingan{{ $loop->iteration }}">
                        @if ($item->status == 'selesai')
                        Bimbingan {{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }} &nbsp - <span
                           class="fw-bold text-success">&nbsp
                           {{ $item->status }}</span>
                        @else
                        Bimbingan {{ date("d-m-Y", strtotime($item->tgl_bimbingan)) }}
                        @endif
                     </button>
                  </h2>
                  <div id="bimbingan{{ $loop->iteration }}" class="accordion-collapse collapse"
                     data-bs-parent="#accordionExample">
                     <div class="accordion-body">
                        <span class="fw-bold d-block">Judul:</span>
                        {{ $item->judul }}
                        <span class="fw-bold mt-3 d-block">Catatan:</span>
                        {{ $item->catatan }}
                        @if (isset($item->revisi))
                        <span class="fw-bold mt-3 d-block">Revisi:</span>
                        {{ $item->revisi }}
                        @else
                        <span class="fw-bold mt-3 d-block">Revisi:</span>
                        -
                        @endif
                     </div>
                  </div>
               </div>

               @endif
               @endforeach
            </div>
            @else
            <p>--belum ada jadwal sebelumnya--</p>
            @endif





         </div>


      </div>
      @endif


   </div>


</div>
@endsection

@section('script')
<script>
$(document).ready(function() {



});
</script>
@endsection