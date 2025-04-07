@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @include('categories.form')
    </form>
</div>
@endsection
