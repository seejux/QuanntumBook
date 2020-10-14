@extends('layouts.app')
@section('content')
<div class="main-content">
    <main class="main">
      <div class="view-container-3">
      <div class="collection-section--1__DHQagG0">
          <button class="item--3ZMpOg-5QU" disabled="">Change password</button>
      </div>
      <br>
      <form method="POST" action="{{ route('change-password') }}" class="form--1pNyeHZ_J6" id="change-password-form">
         <fieldset>
            @csrf
            <div class="field">
                <label class="section-label" for="app-name-input">Old Password *</label>
                <label class="input left--3McDXiCrys headline"><input type="password" value="" name="old-password" required></label>
            </div>
            @error('old-password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <br>

            <div class="field">
                <label class="section-label" for="app-name-input">New Password *</label>
                <label class="input left--3McDXiCrys headline"><input type="password" value="" name="new-password" required></label>
            </div>
            <br>
            <br>

            <div class="field">
                <label class="section-label" for="app-name-input">Confirm New Password *</label>
                <label class="input left--3McDXiCrys headline"><input type="password" value="" name="new-password_confirmation" required></label>
            </div>
            <br>
            @error('new-password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror

            <br>
            <br>
            <button class="button--319u6U1AIl primary--1wekDI7P-q" type="submit" style="margin-top: 0"><span class="text--3HNWf-tIc7">Change Password</span></button>
         </fieldset>
      </form>
    </div>
  </div>
</div>

@endsection
