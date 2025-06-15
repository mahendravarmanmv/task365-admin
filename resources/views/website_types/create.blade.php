@extends('layouts.app')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Create Website Type</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('website-types.index') }}">Website Types</a></li>
    <li class="breadcrumb-item">Create Website Type</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="tile">
      <div class="tile-body">
        <form action="{{ route('website-types.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="category_id">Select Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
              <option value="">-- Select Category --</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ strtoupper($category->category_title) }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group mt-3">
            <label for="type_title">Website Type</label>
            <input type="text" name="type_title" id="type_title" class="form-control" placeholder="e.g. Portfolio, Blog" required>
          </div>

          <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
            <a href="{{ route('website-types.index') }}" class="btn btn-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
