@extends('layouts.base')
@section('body')
<div id="application">
   <div class="login--1dPKvzoqvx">
      <div class="login-container--3KCmvHyz7g">
         <div class="form-container--1a48M_vk4X">
            <div class="logo-container--3Rnp2jIalL">
               <img src="/profile.png" height="60">
            </div>
            <div class="card-header">Welcome</div>
            <form method="POST" action="{{ route('register') }}" class="form--1pNyeHZ_J6">
               <fieldset>
                  @csrf
                  <label class="input-field--31TEuk-dv0">
                     <div class="label-text--2dcgberBAk">{{ __('Username') }}</div>
                  <label class="input-container left--3McDXiCrys">
                     <div class="prepended-container--1HLUlo-uAQ"><span aria-label="fas fa-user" class="fas fa-user input-icon"></span></div>
                     <input id="email" type="email" class="@error('email') is-invalid @enderror user-info-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </label>
                  </label>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <br>
                  <label class="input-field--31TEuk-dv0">
                     <div class="label-text--2dcgberBAk">{{ __('Password') }}</div>
                  <label class="input-container left--3McDXiCrys">
                     <div class="prepended-container--1HLUlo-uAQ"><span aria-label="fas fa-lock" class="fas fa-lock input-icon"></span></div>
                     <input id="password" type="password" class="@error('password') is-invalid @enderror user-info-input" name="password" required autocomplete="current-password">
                  </label>
                  </label>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <br>
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
                  </label>
                  <!-- @if (Route::has('password.request'))
                     <a class="btn btn-link" href="{{ route('password.request') }}">
                         {{ __('Forgot Your Password?') }}
                     </a>
                     @endif -->
                  <div class="buttons--2B7RG6G7uu">
                     <button class="button--319u6U1AIl primary--1wekDI7P-q" type="submit"><span class="text--3HNWf-tIc7">{{ __('Login') }}</span></button>
                  </div>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="form-group row">
   <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
   <div class="col-md-6">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      @error('name')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>
<div class="form-group row">
   <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
   <div class="col-md-6">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
      @error('email')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>
<div class="form-group row">
   <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
   <div class="col-md-6">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
      @error('password')
      <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
   </div>
</div>
<div class="form-group row">
   <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
   <div class="col-md-6">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
   </div>
</div>
<div class="form-group row mb-0">
   <div class="col-md-6 offset-md-4">
      <button type="submit" class="btn btn-primary">
      {{ __('Register') }}
      </button>
   </div>
</div>
@endsection
