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
            @if ($dosen)
            @if ($dosen->nama_dosen)
            <p>{{ $dosen->nama_dosen }}</p>
            @endif
            @else
            <p class="text-danger fw-bold">belum ada dosen pembimbing</p>
            @endif
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
            <p>{{ date("d-m-Y", strtotime($proposal->created_at)) }}</p>
            @else
            <p class="text-danger fw-bold">belum mengajukan judul</p>
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
                  @if ($proposal->tugas_akhir_id)
                  <p class="text-success fw-bold"><i class="fas fa-check"></i> telah disetujui</p>
                  @elseif ($proposal->tugas_akhir_id == null)
                  <p class="text-info fw-bold"><i class="fas fa-history"></i> menunggu persetujuan</p>
                  @endif
                  @else
                  <p class="text-danger">belum ada data tugas akhir</p>
                  @endif

                  @if ($proposal)
                  <button class="mt-4 btn btn-warning bEdit"><i class="fas fa-pencil-alt"></i> Edit tugas
                     akhir</button>
                  @else
                  <button class="mt-4 btn btn-primary bTambah"><i class="fas fa-plus"></i> Tambah tugas
                     akhir</button>
                  @endif
               </div>


               <!-- apabila sudah ada data tugas akhir -->
               <script>
               let topik = '';
               let judul = '';
               let abstrak = '';
               let idProposal = '';
               let idTugasAkhir = '';
               </script>
               @if (isset($proposal->abstrak))
               <script>
               abstrak = "{{ $proposal->abstrak }}";
               </script>
               @endif
               @if ($proposal)
               <script>
               topik = "{{ $proposal->topik }}";
               judul = "{{ $proposal->judul }}";
               idProposal = "{{ $proposal->id }}";
               idTugasAkhir = "{{ $proposal->tugas_akhir_id }}";
               </script>
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
                              <button class="btn btn-primary bAbstrak" data-bs-toggle="modal"
                                 data-bs-target="#abstrakModal">Abstrak</button>
                              <button class="btn btn-primary">File</button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif

               <div class="col-md-9 divFormProposal" style="display: none;">
                  <form class="formProposal" action="" method="POST">
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
                     <div class="divAcc" hidden>
                        <div class="mb-3">
                           <label for="abstrakForm">Abstrak</label>
                           <textarea name="abstrak" class="form-control"
                              placeholder="Masukan isi abstrak (max: 250 kata)" id="abstrakForm"
                              style="height: 230px"></textarea>
                        </div>
                        <div class="mb-3">
                           <label for="proposalForm" class="form-label">File Proposal</label>
                           <input type="file" name="file" class="form-control" id="proposalForm">
                        </div>
                     </div>
                     <!-- apabila sudah di acc judulnya -->

                     <button type="button" class="btn btn-danger text-light bClear"><i class="fas fa-eraser"></i>
                        Clear</button>
                     <button type="submit" class="btn btn-primary bSubmit"><i class="fas fa-upload"></i> Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="abstrakModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="exampleModalLabel">Isi Abstrak</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p id="isiAbstrak"></p>
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
      $(".formProposal").attr("action", "{{ route('tugasakhir.create') }}");
   });

   $(".bClear").click(function() {
      $('.formProposal :input').val('');
   });

   if ('{{ $proposal }}') {
      $(".bEdit").click(function() {
         $(".divFormProposal").show();
         $('.divDetailProposal').hide();
         $(".formProposal").attr("action", "{{ route('tugasakhir.update') }}");
         $('.bEdit').prop("disabled", true);

         $("#topikForm").val(topik);
         $("#judulForm").val(judul);

         if (abstrak) {
            $("#abstrakForm").val(abstrak);
         }

         if ($("#idInput").length) {
            $("#idInput").remove();
            let idInputElement = `<input id="idInput" type="text" name="id" value="${idProposal}" hidden>`;
            $(".formProposal").append(idInputElement);
         } else {
            let idInputElement = `<input id="idInput" type="text" name="id" value="${idProposal}" hidden>`;
            $(".formProposal").append(idInputElement);
         }

         if (idTugasAkhir) {
            $(".divAcc").prop("hidden", false);
         }

      });


      $(".bAbstrak").click(function() {
         if (abstrak) {
            $("#isiAbstrak").text(abstrak);
         } else {
            $("#isiAbstrak").text('abstrak belum ditambahkan');
         }
      });
   }

   isiAbstrak

});
</script>
@endsection