@extends('layouts.admin')
@section('page','Manajemen User')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Dosen & Mahasiswa</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Jumlah Dosen</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-success">{{ $dosen }} orang</span></li>
            </ul>
         </div>
      </div>
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Jumlah Mahasiswa</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-success">{{ $mhs }} orang</span>
               </li>
            </ul>
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
               <h3 class="box-title mb-0">List User</h3>
               <a href="" class="box-title mb-0 text-white btn btn-success bTambah" data-bs-toggle="modal"
                  data-bs-target="#mainModel">Tambah User</a>
            </div>
            <div class="table-responsive">
               <table id="mainTable" class="table no-wrap data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border">No.</th>
                        <th class="border">Nama</th>
                        <th class="border">Kategori</th>
                        <th class="border">NIDN/NIM</th>
                        <th class="border">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <script>
                     var user = [];
                     </script>
                     @foreach ($user as $item)
                     <script>
                     var userObject = {};
                     userObject.id = '{{ $item->id }}';
                     userObject.roleId = '{{ $item->role_id }}';
                     userObject.name = '{{ $item->name }}';
                     userObject.username = '{{ $item->username }}';
                     userObject.email = '{{ $item->email }}';
                     userObject.avatar = '{{ $item->avatar }}';
                     user.push(userObject);
                     </script>
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="txt-oflo">{{ $item->name }}</td>
                        @if ($item->role == 'Dosen')
                        <td class="txt-oflo">Dosen</td>
                        @else
                        <td class="txt-oflo">Mahasiswa</td>
                        @endif
                        <td class="txt-oflo">{{ $item->username }}</td>
                        <td class="d-flex">
                           <a href="" class="btn btn-warning mx-1 bDetail" idUser="{{ $item->id }}" title="Detail"
                              data-bs-toggle="modal" data-bs-target="#mainModel"><i class="fas fa-eye"></i></a>
                           <form action="{{ route('user.destroy') }}" class="pull-left" method="delete">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="id" value="{{ $item->id }}">
                              <button type="submit"
                                 onclick="return confirm('apakah kamu yakin menghapus {{$item->name}}?')"
                                 class="btn btn-danger mx-1" title="Delete"><i
                                    class="fas fa-trash-alt text-white"></i></button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- model detail dan edit user -->
   <div class="modal fade " id="mainModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
      style="z-index: 9999;">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title fw-bold" id="mainModelLabel">Detail User</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="formSubmit" action="" method="post">
                  @csrf
                  <div class="mb-3">
                     <label for="input-nama" class="col-form-label">Nama</label>
                     <input type="text" class="form-control" name="name" id="input-nama" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-kategori" class="col-form-label">Kategori</label>
                     <select class="form-select" name="role_id" id="input-kategori" required>
                        <option selected>--pilih kategori--</option>
                        <option value="2">Dosen</option>
                        <option value="3">Mahasiswa</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="input-username" class="col-form-label">NIDN / NIM</label>
                     <input type="text" class="form-control" name="username" id="input-username" required>
                  </div>
                  <div class="mb-3">
                     <label for="input-email" class="col-form-label">Email</label>
                     <input type="email" class="form-control" name="email" id="input-email" required>
                  </div>
                  <div id="divPass" class="mb-3">
                     <label for="input-password" class="col-form-label">Password</label>
                     <input type="password" class="form-control" name="password" id="input-password">
                  </div>
                  <div class="mt-4" style="float: right;">
                     <button type="button" class="btn btn-warning bEdit"><i class="fas fa-pencil-alt"></i> Edit</button>
                     <button type="button" class="btn btn-danger text-light bCancel" data-bs-dismiss="modal"><i
                           class=" fas fa-eraser"></i> Cancel</button>
                     <button type="submit" class="btn btn-primary bSubmit"><i class="fas fa-upload"></i> Submit</button>
                  </div>
               </form>
            </div>
            <!-- <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
            </div> -->
         </div>
      </div>
   </div>


</div>
@endsection

@section('script')
<script>
$(document).ready(function() {

   let idUser = '';

   $(".bTambah").click(function() {
      $("#mainModelLabel").text('Tambah User');
      $("#formSubmit").attr("action", "{{ route('user.create') }}");
      $(".bEdit").hide();
      $(".bCancel").hide();
      $(".bSubmit").show();
      $("#divPass").show();
      $("#formSubmit")[0].reset();
      $("select.form-select option:eq(0)").attr("selected", true);
      $("select.form-select option:eq(1)").attr("selected", false);
      $("select.form-select option:eq(2)").attr("selected", false);
      $("#input-password").attr("required", true);
      $("#formSubmit :input:not(:button)").prop("disabled", false);
      $("#idInput").remove();
   });

   $("#mainTable").on('click', '.bDetail', function() {
      $("#mainModelLabel").text('Detail User');
      $("#formSubmit").attr("action", "{{ route('user.update') }}");
      $(".bEdit").show();
      $(".bCancel").hide();
      $(".bSubmit").hide();
      $("#formSubmit")[0].reset();
      $("#formSubmit :input:not(:button)").prop("disabled", true);
      $("#divPass").hide();

      idUser = $(this).attr('idUser');

      user.forEach(element => {
         if (element.id == idUser) {
            $("#input-nama").val(element.name);
            $("#input-username").val(element.username);
            $("#input-email").val(element.email);

            if (element.roleId == 2) {
               $("select.form-select option:eq(0)").attr("selected", false);
               $("select.form-select option:eq(1)").attr("selected", true);
            } else {
               $("select.form-select option:eq(0)").attr("selected", false);
               $("select.form-select option:eq(2)").attr("selected", true);
            }
         }
      });


   });
   $(".bEdit").click(function() {
      $("#formSubmit :input:not(:button)").prop("disabled", false);
      $("#mainModelLabel").text('Edit User');
      $(".bEdit").hide();
      $(".bCancel").show();
      $(".bSubmit").show();

      if ($("#idInput").length) {
         $("#idInput").remove();
         let idInputElement = `<input id="idInput" type="text" name="id" value="${idUser}" hidden>`;
         $("#formSubmit").append(idInputElement);
      } else {
         let idInputElement = `<input id="idInput" type="text" name="id" value="${idUser}" hidden>`;
         $("#formSubmit").append(idInputElement);
      }

   });

   if (!($("#mainModel").is(":focus"))) {
      $("#idInput").remove();
   }

});
</script>
@endsection