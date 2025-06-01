@extends('layouts.app')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Edit Banner</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item">Edit Banner</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="tile">
      <div class="tile-body">
	  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('banner.update') }}" method="POST">
          @csrf         
          <div class="mb-3">
            <label>Welcome Text</label>
            <input type="text" name="welcome_text" placeholder="Welcome Text" class="form-control" value="{{ old('welcome_text', $banner->welcome_text ?? '') }}">			
          </div>
		  
		  <div class="mb-3">
            <label>Banner Title</label>
            <input type="text" name="banner_title" placeholder="Banner Title" class="form-control" value="{{ old('banner_title', $banner->banner_title ?? '') }}">			
          </div>


          <div class="mb-3">
            <label>Banner Description</label>
            <textarea name="banner_description" class="form-control" placeholder="Banner Description">{{ old('banner_description', $banner->banner_description ?? '') }}</textarea>           
          </div>

         
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Banner</button>
            <a class="btn btn-secondary" href="{{ route('banner.edit') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection