@extends('layouts.admin')
@section('page','Chat Bimbingan')
@section('breadcrumb')
<li><a href="#" class="fw-normal"></a>{{ $mahasiswa->name }}</li>
@endsection

@section('content')
<div class="container-fluid">

   @if($errors->any())
   <div class="alert alert-danger" role="alert">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
   </div>
   @endif



   <div class="row mb-3">
      <form action="{{ route('chat.dosen.send') }}" method="post" autocomplete="off">
         @csrf
         <input type="text" value="{{ $mahasiswa->id }}" name="mahasiswa_id" hidden>
         <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-paper-plane"></i></span>
            <input type="text" class="form-control" placeholder="Masukan isi pesan" aria-label="Masukan isi pesan"
               aria-describedby="basic-addon1" name="isi" required>
            <button type="submit" class="btn btn-primary">Kirim</button>
         </div>
      </form>

   </div>


   <!-- apabila ada/tidak chat -->
   @if ($chat->isEmpty())
   <div class="alert alert-info" role="alert">
      Belum ada chatting
   </div>
   @else
   <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 overflow-auto" style="max-height: 400px;" id="messageBody">

         @foreach ($chat as $item)
         <!-- apabila sender dosen -->
         @if ($item->sender == 'dosen')
         <div class="row">
            <div class="col-lg-6 col-md-6"></div>
            <div class="col-lg-6 col-md-6">
               <div class="rounded-3 card p-3 bg-info text-white" style="max-width: 100rem; float: right;">
                  {{ $item->isi }}
               </div>
            </div>
         </div>
         @else
         <!-- apabila sender dosen -->
         <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="rounded-3 card p-3" style="max-width: 100rem;">
                  {{ $item->isi }}
               </div>
            </div>
            <div class=" col-lg-6 col-md-6">
            </div>
         </div>
         @endif
         @endforeach
      </div>

   </div>
   @endif
   <!-- apabila ada chat -->




</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
   const messageBody = document.querySelector('#messageBody');
   messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
});
</script>
@endsection