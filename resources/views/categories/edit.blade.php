@extends('layouts.app')

@section('content')
<div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Edit Category</h1>       
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
		  <li class="breadcrumb-item">Edit Category</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="tile">            
            <div class="tile-body">
              <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
				@method('PUT')
				@include('categories.form')
			  </form>
            </div>
            
          </div>
        </div>
              
      </div>
@endsection
