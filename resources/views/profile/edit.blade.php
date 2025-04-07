@extends('layouts.app')

@section('content')


<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Update Profile</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Profile</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Profile Information</h3>
      <div class="tile-body">
        @if (session('status') === 'profile-updated')
        <div class="alert alert-success mt-3">
          {{ __('Profile updated successfully.') }}
        </div>
        @endif
        <form method="post" action="{{ route('profile.update') }}">
          @csrf
          @method('patch')
          <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
          </div>


      </div>
      <div class="tile-footer">
        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
      </div>
      </form>
    </div>
  </div>
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Update Password</h3>
      <div class="tile-body">

        <form method="POST" action="{{ route('profile.password.update') }}">
          @csrf

          @if (session('status') === 'password-updated')
          <div class="alert alert-success mt-3">
            {{ __('Password updated successfully.') }}
          </div>
          @endif
          <div class="form-group row">
            <label class="control-label col-md-3">Current Password</label>
            <div class="col-md-8">
              <input type="password" id="current_password" name="current_password" class="form-control" autocomplete="current-password">
              @error('current_password')
              <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">New Password</label>
            <div class="col-md-8">
              <input type="password" name="password" value="{{ old('password') }}" class="form-control">
              @error('password')
              <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Confirm Password</label>
            <div class="col-md-8">
              <input type="password" name="password_confirmation" class="form-control">
              @error('password_confirmation')
              <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="tile-footer">
            <button class="btn btn-primary" type="submit">Update Password</button>
          </div>
        </form>
      </div>
    </div>

  </div>


  @endsection