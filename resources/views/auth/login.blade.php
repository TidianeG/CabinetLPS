@extends('layouts.app')

@section('content')

<div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <nav class="navbar navbar-light ">
                    <div class="container-fluid pt-3 pb-3">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('assets/img/favicon/logo_lps_text.png')}}" alt="" width="100%" height="100%" class="d-inline-block align-text-top">
                        </a>
                    </div>
                </nav>
                <!-- /Logo -->
              <h4 class="mb-3 text-center font-bold">LOGIN <i class="fa-solid fa-lock"></i></h4>
              
              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">Username ou Email</label>
                    <input type="text" class="form-control {{ $errors->has('email') || $errors->has('username') ? 'is-invalid' : '' }} " id="login" name="login" placeholder="Enter votre identifiant" value="{{ old('login') }}" required autocomplete="login" autofocus />
                    @if ($errors->has('email') || $errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') ?: $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Mot de passe</label>
                    
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label" for="remember-me"> Se souvenir de moi </label>
                  </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">S'identifier</button>
                    
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

        <!--div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
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
                </div>
            </div>
        </div-->
@endsection
