@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Update Profile</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password (Leave blank to keep current password)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
