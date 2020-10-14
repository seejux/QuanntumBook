@extends('layouts.base')
@section('body')
<div id="application">
   <div class="login--1dPKvzoqvx">
      <div class="login-container--3KCmvHyz7g">
         <div class="form-container--1a48M_vk4X">
            <div class="logo-container--3Rnp2jIalL">
               <img src="/img/profile.png" height="60">
            </div>
            <div class="card-header">Welcome</div>
            <form method="POST" action="{{ route('login') }}" class="form--1pNyeHZ_J6">
               <fieldset>
                  @csrf
                  <label class="input-field--31TEuk-dv0">
                     <div class="label-text--2dcgberBAk">{{ __('Email') }}</div>
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
                  <div class="buttons--2B7RG6G7uu">
                     <div style="display: flex">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 18px; height: 18px">
                        <label class="form-check-label" for="remember" style="padding-left: 8px; font-size: 14px">
                        {{ __('Remember Me') }}
                        </label>
                     </div>
                     <button class="button--319u6U1AIl primary--1wekDI7P-q" type="submit" style="margin-top: 0"><span class="text--3HNWf-tIc7">{{ __('Login') }}</span></button>
                  </div>
               </fieldset>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
