@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i> Edit Website Type</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('website-types.index') }}">Website Types</a></li>
        <li class="breadcrumb-item">Edit Website Type</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="tile">
            <div class="tile-body">
                <form action="{{ route('website-types.update', $websiteType->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $websiteType->category_id == $category->id ? 'selected' : '' }}>
                                    {{ strtoupper($category->category_title) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Website Type Title</label>
                        <input type="text" name="type_title" class="form-control" placeholder="Enter Website Type" value="{{ old('type_title', $websiteType->type_title) }}" required>
                        @error('type_title') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                    <a class="btn btn-secondary" href="{{ route('website-types.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
