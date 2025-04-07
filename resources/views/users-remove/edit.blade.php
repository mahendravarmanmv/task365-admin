@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ $user->company_name }}">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>
        <div class="mb-3">
            <label>Business Proof</label>
            <input type="file" name="business_proof" class="form-control">
            @if($user->business_proof)
                <a href="{{ asset('storage/' . $user->business_proof) }}" target="_blank">View Existing</a>
            @endif
        </div>
        <div class="mb-3">
            <label>Identity Proof</label>
            <input type="file" name="identity_proof" class="form-control">
            @if($user->identity_proof)
                <a href="{{ asset('storage/' . $user->identity_proof) }}" target="_blank">View Existing</a>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection