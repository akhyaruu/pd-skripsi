@extends('layouts.admin')
@section('page','Jadwal Bimbingan')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Jadwal</a></li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Total Post</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-success"></span></li>
            </ul>
         </div>
      </div>
      <div class="col-lg-6 col-md-6">
         <div class="white-box analytics-info">
            <h3 class="box-title">Last Created on</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-success"></span>
               </li>
            </ul>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">
            <div class="d-md-flex justify-content-between mb-3">
               <h3 class="box-title mb-0">List Post</h3>
               <a href="" class="box-title mb-0 text-white btn btn-success">Create Post</a>
            </div>
            <div class="table-responsive">
               <table class="table no-wrap data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border">#</th>
                        <th class="border">Title</th>
                        <th class="border">Content</th>
                        <th class="border">User_id</th>
                        <th class="border">Action</th>
                     </tr>
                  </thead>
                  <tbody>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection