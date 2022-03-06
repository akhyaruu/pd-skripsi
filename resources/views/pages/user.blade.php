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

   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">
            <div class="d-md-flex justify-content-between mb-3">
               <h3 class="box-title mb-0">List User</h3>
               <a href="" class="box-title mb-0 text-white btn btn-success">Tambah User</a>
            </div>
            <div class="table-responsive">
               <table class="table no-wrap data-table table-bordered">
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
                     @foreach ($user as $item)
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
                           <a href="" type="button" class="btn btn-primary mx-1" title="Edit" data-bs-toggle="modal"
                              data-bs-target="#exampleModal"><i class="fas fa-pencil-alt"></i></a>

                           <a href="" class="btn btn-warning mx-1" title="Detail"><i class="fas fa-eye"></i></a>
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


   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">New message</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form>
                  <div class="mb-3">
                     <label for="recipient-name" class="col-form-label">Recipient:</label>
                     <input type="text" class="form-control" id="recipient-name">
                  </div>
                  <div class="mb-3">
                     <label for="message-text" class="col-form-label">Message:</label>
                     <textarea class="form-control" id="message-text"></textarea>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Send message</button>
            </div>
         </div>
      </div>
   </div>


</div>
@endsection