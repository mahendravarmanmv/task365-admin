@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-edit"></i> Edit Vendor</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendors</a></li>
        <li class="breadcrumb-item">Edit Vendor</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="tile">
            <div class="tile-body">
                <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $vendor->name }}" placeholder="Enter Name">
                        @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $vendor->email }}" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <label>Company Name (optional)</label>
                        <input type="text" name="company_name" class="form-control" value="{{ $vendor->company_name }}" placeholder="Enter Company Name">
                    </div>
                    <div class="mb-3">
                        <label>Website (optional)</label>
                        <input type="text" name="website" class="form-control" value="{{ $vendor->website }}">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $vendor->phone }}" placeholder="Enter Phone Number">
                        @error('phone') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ $vendor->whatsapp_number }}" placeholder="Enter WhatsApp Number">
                        @error('whatsapp_number') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="categories[]" class="form-control select2" multiple>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $vendor->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->category_title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Business Proof</label>
                        <input type="file" name="business_proof" class="form-control">
                        @if($vendor->business_proof)
                        <a href="{{ config('app.domain') . '/storage/' . $vendor->business_proof }}" target="_blank">View Existing</a>
                        @endif
                        @error('business_proof') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Identity Proof</label>
                        <input type="file" name="identity_proof" class="form-control">
                        @if($vendor->identity_proof)
                        <a href="{{ config('app.domain') . '/storage/' . $vendor->identity_proof }}" target="_blank">View Existing</a>
                        @endif
                        @error('identity_proof') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Vendor
                    </button>

                    <!-- Approve / Block Toggle Button -->
                    <button type="submit" class="btn {{ $vendor->approved ? 'btn-danger' : 'btn-success' }}" name="toggle_approval" value="1">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        {{ $vendor->approved ? 'Block Vendor' : 'Approve Vendor' }}
                    </button>

                    <a class="btn btn-secondary" href="{{ route('vendors.index') }}">
                        <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancel
                    </a>

                </form>
            </div>

        </div>
    </div>

</div>
@endsection
