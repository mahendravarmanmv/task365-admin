@extends('layouts.app-register')

@section('content')

@php
    if (!session('registration_success')) {
        header("Location: " . route('login'));
        exit;
    }
@endphp

<div class="container d-flex align-items-center justify-content-center min-vh-100 bg-gradient">
    <div class="bg-white p-5 rounded shadow-lg text-center" style="max-width: 600px; width: 100%;">
        <h3 class="text-success mb-3">
            <i class="fa fa-check-circle me-2"></i> Registration Successful!
        </h3>
        <p class="text-muted">
            {{ session('message') }}
        </p>
        <a href="{{ route('login') }}" class="btn btn-outline-success mt-3">Go to Login</a>
    </div>
</div>

@endsection
