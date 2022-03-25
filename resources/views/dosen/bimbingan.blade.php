@extends('layouts.admin')
@section('page','Manajemen Bimbingan')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Pemantauan Bimbingan Mahasiswa</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Jumlah Bimbingan</h3>
            <p class="text-success fw-bold">{{ $jumlahBimbingan }} Mahasiswa</p>
         </div>
      </div>
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Bimbingan Baru</h3>
            <p class="text-success fw-bold">{{ $jumlahBimbinganBaru }} Mahasiswa</p>
            <small class="text-info" style="float: right;" data-bs-toggle="modal" data-bs-target="#mhsModal">cek
               mahasiswa <i class="fas fa-arrow-right"></i></small>
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
               <h3 class="box-title mb-0">List Mahasiswa</h3>
            </div>
            <div class="table-responsive">
               <table class="table data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border">No.</th>
                        <th class="border">Mahasiswa</th>
                        <th class="border">Topik</th>
                        <th class="border">Judul</th>
                        <th class="border">Action</th>
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
                     proposalObject.topik = '{{ $item->topik }}';
                     proposalObject.judul = '{{ $item->judul }}';
                     proposal.push(proposalObject);
                     </script>
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="txt-oflo">{{ $item->mahasiswa }}</td>
                        <td class="txt-oflo">{{ $item->topik }}</td>
                        <td class="txt-oflo">{{ $item->judul }}</td>
                        <td style="min-width:170px">
                           <a href="{{ route('m-bimbingan.jadwal', ['id' => $item->id]) }}" type="button"
                              class="btn btn-primary" title="Jadwal Bimbingan"><i class="fas fa-calendar-minus"></i>
                           </a>
                           @if ($item->file)
                           <a type="button" href="{{ url('/').'/'.$item->file }}" class="btn btn-primary"
                              title="File Proposal"><i class="fas fa-file-alt"></i></a>
                           @else
                           <button class="btn btn-secondary" title="File Proposal" disabled><i
                                 class="fas fa-file-alt"></i></button>
                           @endif

                           <button class="btn btn-warning bEdit" idProposal="{{ $item->id }}" title="Edit Proposal"
                              data-bs-toggle="modal" data-bs-target="#editModal"><i
                                 class="fas fa-pencil-alt"></i></button>
                           <a href="{{ route('chat.dosen', ['id' => $item->mahasiswa_id]) }}" type="button"
                              class="btn btn-info text-white" title="Chat Mahasiswa"><i
                                 class="fas fa-paper-plane"></i></a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>


   <!-- Edit Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <form action="{{ route('m-bimbingan.tugasakhir.update') }}" method="POST">
               @csrf
               <input type="text" id="input-id" name="id" hidden required>
               <div class="modal-header">
                  <h5 class="modal-title fw-bold">Ubah Proposal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="input-topik" class="col-form-label">Topik</label>
                     <input type="text" class="form-control" name="topik" id="input-topik" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-judul" class="col-form-label">Judul</label>
                     <textarea name="judul" class="form-control" id="input-judul" style="height: 100px"
                        required></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary bSubmit"><i class="fas fa-upload"></i>&nbsp;
                     Submit</button>

               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Cek Mahasiswa Modal -->
   <div class="modal fade" id="mhsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">List Mahasiswa</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <ul class="list-group">
                  @foreach ($proposal as $item)
                  @if (isset($item->bimbingan_id))
                  @else
                  <li class="list-group-item">{{ $item->mahasiswa }}</li>
                  @endif
                  @endforeach
               </ul>
            </div>
            <div class="modal-footer">

            </div>
         </div>
      </div>
   </div>

</div>
@endsection

@section('script')
<script>
$(document).ready(function() {

   let idProposal = '';

   $(".bEdit").click(function() {
      idProposal = $(this).attr('idProposal');

      proposal.forEach(element => {
         if (element.id == idProposal) {
            $("#input-id").val(element.id);
            $("#input-topik").val(element.topik);
            $("#input-judul").val(element.judul);
         }
      });
   });

   $('textarea').keypress(function(event) {
      if (event.keyCode == 13) {
         event.preventDefault();
      }
   });



});
</script>
@endsection