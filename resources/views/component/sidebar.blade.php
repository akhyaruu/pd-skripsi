<li class="sidebar-item pt-2">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}" aria-expanded="false">
      <i class="far fa-clock" aria-hidden="true"></i>
      <span class="hide-menu">Dashboard</span>
   </a>
</li>
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('profile') }}" aria-expanded="false">
      <i class="fa fa-user" aria-hidden="true"></i>
      <span class="hide-menu">Profil</span>
   </a>
</li>

<!-- admin -->
@if (Auth::user()->role_id == 1)
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user') }}" aria-expanded="false">
      <i class="fas fa-users" aria-hidden="true"></i>
      <span class="hide-menu">Manajemen User</span>
   </a>
</li>
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('m-tugasakhir') }}"
      aria-expanded="false"><i class="fas fa-book" aria-hidden="true"></i>
      <span class="hide-menu">Manajemen Tugas Akhir</span>
   </a>
</li>
@endif

<!-- dosen -->
@if (Auth::user()->role_id == 2)
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('m-bimbingan') }}" aria-expanded="false">
      <i class="fas fa-calendar-check" aria-hidden="true"></i>
      <span class="hide-menu">Bimbingan</span>
   </a>
</li>
@endif


<!-- mahasiswa -->
@if (Auth::user()->role_id == 3)
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('tugasakhir') }}" aria-expanded="false">
      <i class="fas fa-book" aria-hidden="true"></i>
      <span class="hide-menu">Tugas Akhir</span>
   </a>
</li>
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('bimbingan') }}" aria-expanded="false">
      <i class="fas fa-calendar-check" aria-hidden="true"></i>
      <span class="hide-menu">Bimbingan</span>
   </a>
</li>
<li class="sidebar-item">
   <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('chat.mahasiswa') }}"
      aria-expanded="false">
      <i class="fas fa-paper-plane" aria-hidden="true"></i>
      <span class="hide-menu">Chat Konsultasi</span>
   </a>
</li>
@endif