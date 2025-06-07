@extends('layouts.app')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Edit Lead</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('leads.index') }}">Leads</a></li>
    <li class="breadcrumb-item">Edit Lead</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="tile">
      <div class="tile-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('banner.update') }}">
        @csrf

        <div>
            <label>Welcome Text:</label>
            <input type="text" name="welcome_text" value="{{ old('welcome_text', $banner->welcome_text ?? '') }}" required>
        </div>

        <div>
            <label>Banner Title:</label>
            <input type="text" name="banner_title" value="{{ old('banner_title', $banner->banner_title ?? '') }}" required>
        </div>

        <div>
            <label>Banner Description:</label>
            <textarea name="banner_description" required>{{ old('banner_description', $banner->banner_description ?? '') }}</textarea>
        </div>

        <button type="submit">Update Banner</button>
    </form>
      </div>
    </div>
  </div>
</div>
@endsection