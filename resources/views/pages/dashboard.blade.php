@extends('layouts.admin')
@section('page','Dashboard')
@section('breadcrumb')
<li><a href="#" class="fw-normal">Dashboard</a></li>
@endsection

@section('content')
<div class="container-fluid">

   <div class="row justify-content-center">
      <div class="col-lg-4 col-md-12">
         <div class="white-box analytics-info">
            <h3 class="box-title">Total Visitor</h3>
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
      <div class="col-lg-4 col-md-12">
         <div class="white-box analytics-info">
            <h3 class="box-title">Total User Register</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash2"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-purple"></span></li>
            </ul>
         </div>
      </div>
      <div class="col-lg-4 col-md-12">
         <div class="white-box analytics-info">
            <h3 class="box-title">Unique Visitor</h3>
            <ul class="list-inline two-part d-flex align-items-center mb-0">
               <li>
                  <div id="sparklinedash3"><canvas width="67" height="30"
                        style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                  </div>
               </li>
               <li class="ms-auto"><span class="counter text-info"></span>
               </li>
            </ul>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">
            <div class="d-md-flex mb-3">
               <h3 class="box-title mb-0">User Register</h3>
            </div>
            <div class="table-responsive">
               <table class="table no-wrap data-table table-bordered">
                  <thead>
                     <tr>
                        <th class="border-top-0">#</th>
                        <th class="border-top-0">Name</th>
                        <th class="border-top-0">Email</th>
                        <th class="border-top-0">Register on</th>
                     </tr>
                  </thead>
                  <tbody>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="white-box">
            <div class="d-md-flex mb-3">
               <h3 class="box-title mb-0">Visitor terkini</h3>
            </div>
            <div class="table-responsive">
               <table class="table no-wrap">
                  <thead>
                     <tr>
                        <th class="border-top-0">#</th>
                        <th class="border-top-0">IP address</th>
                        <th class="border-top-0">Location</th>
                        <th class="border-top-0">Count</th>
                        <th class="border-top-0">Time</th>
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