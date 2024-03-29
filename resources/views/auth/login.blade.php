@extends('layouts.app')

@section('content')
<style>
@media (min-width:769px) {
   main {
      margin-top: 100px;
   }
}
</style>

<!-- <main>
   <div class="container-fluid">
      <div class="row align-items-center">
         <div class="col-md-6 col-sm-12">
            <img src="{{ asset('images/new-logo.png') }}" class="img-fluid" alt="">
         </div>
         <div class="col-md-6 col-sm-12">
            <div class="row align-items-center">
               <div class="col text-primary">
                  <div class="d-flex justify-content-center">
                     <button class="btn mx-2 btn-primary btn-rounded" id="btn-login">Login</button>
                     <button class="btn mx-2 btn-outline-primary btn-rounded" id="btn-register">Register</button>
                  </div>
                  <div class="cards" id="login-card">
                     <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                           @csrf

                           <div class="form-group row">
                              <label for="username"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Email or Username') }}</label>

                              <div class="col-md-6">
                                 <input id="username" type="username"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                 @error('username')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="password"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                              <div class="col-md-6">
                                 <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                       {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                       {{ __('Remember Me') }}
                                    </label>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                 </button>

                                 @if (Route::has('password.request'))
                                 <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="cards" id="register-card">
                     <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                           @csrf

                           <div class="form-group row">
                              <label for="name"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                              <div class="col-md-6">
                                 <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                 @error('name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="username"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                              <div class="col-md-6">
                                 <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                 @error('username')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="email"
                                 class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                              <div class="col-md-6">
                                 <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="password"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                              <div class="col-md-6">
                                 <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="password-confirm"
                                 class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                              <div class="col-md-6">
                                 <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                              </div>
                           </div>

                           <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main> -->



<!-- login lama -->
<!-- <main>
   <div class="container-fluid">
      <div class="row justify-content-center align-items-center mt-5">

         <div class=" col-md-6 col-sm-12">

            <div class="card rounded">
               <div class="">
                  <div class="text-primary">


                     <div class="cards" id="login-card">
                        <div class="card-body">
                           <form method="POST" action="{{ route('login') }}">
                              @csrf

                              <div class="form-group row">
                                 <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email or Username') }}</label>

                                 <div class="col-md-6">
                                    <input id="username" type="username"
                                       class="form-control @error('username') is-invalid @enderror" name="username"
                                       value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                 <div class="col-md-6">
                                    <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                          {{ old('remember') ? 'checked' : '' }}>

                                       <label class="form-check-label" for="remember">
                                          {{ __('Remember Me') }}
                                       </label>
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group row mb-0">
                                 <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       {{ __('Login') }}
                                    </button>


                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>



                  </div>
               </div>

            </div>

         </div>


      </div>
   </div>
</main> -->



<!-- login baru -->
<section class="">
   <div class="px-4 py-5 px-md-5 text-lg-start" style="background-color: hsl(0, 0%, 96%)">
      <div class="container py-5">
         <div class="row py-4 gx-lg-5 align-items-center">

            <div class="col-lg-5 mb-5 mb-lg-0">
               <h1 class="my-5 display-6 fw-bold ls-tight">
                  Sistem <br />
                  <span class="text-primary">Pendampingan Skripsi</span>
               </h1>
            </div>

            <div class="col-lg-7 mb-5 mb-lg-0">
               <div class="card">
                  <div class="card-body py-5 px-md-5">

                     <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                           <label class="form-label">Email or Username</label>
                           <input id="username" type="username"
                              class="form-control @error('username') is-invalid @enderror" name="username"
                              value="{{ old('username') }}" required autocomplete="off" autofocus>
                           @error('username')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>

                        <div class="mb-3">
                           <label class="form-label">Password</label>
                           <input id="password" type="password"
                              class="form-control @error('password') is-invalid @enderror" name="password" required
                              autocomplete="off">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>

                        <div class="d-grid gap-2 mx-auto pt-3">
                           <button class="btn btn-primary py-2" type="submit">Sign in</button>
                        </div>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</section>


@endsection