@extends('layouts.app')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit"></i> Create Lead</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('leads.index') }}">Leads</a></li>
    <li class="breadcrumb-item">Create Lead</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="tile">
      <div class="tile-body">
        <form action="{{ route('leads.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          {{-- Category & Website Type (Two columns in a row) --}}
          <div class="row mb-3">
            {{-- Category --}}
            <div class="col-md-6">
              <label>Category</label>
              <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->category_title }}
                </option>
                @endforeach
              </select>
              @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            {{-- Website Type --}}
            <div class="col-md-6">
              <label>Website Type</label>
              <select name="website_type" class="form-control" id="websiteTypeSelect">
                <option value="">Select Website Type</option>
              </select>
              @error('website_type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>


          {{-- Name & Email --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Name</label>
              <input type="text" name="lead_name" class="form-control" placeholder="Enter Lead Name" value="{{ old('lead_name') }}">
              @error('lead_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="text" name="lead_email" class="form-control" placeholder="Enter Lead Email" value="{{ old('lead_email') }}">
              @error('lead_email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Phone & Location --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Mobile</label>
              <input type="text" name="lead_phone" class="form-control" placeholder="Enter Lead Mobile number" value="{{ old('lead_phone') }}">
              @error('lead_phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Location</label>
              <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{ old('location') }}">
              @error('location') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Business Name & Reference Website --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Business Name</label>
              <input type="text" name="business_name" class="form-control" placeholder="Enter Business Name" value="{{ old('business_name') }}">
              @error('business_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Reference Website</label>
              <input type="text" name="reference_website" class="form-control" placeholder="Enter Reference Website" value="{{ old('reference_website') }}">
              @error('reference_website') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Budget Range (Already in 2 columns) --}}
          <div class="mb-3">
            <label>Client Budget Range</label>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" name="budget_min" class="form-control" placeholder="Minimum Budget" value="{{ old('budget_min') }}">
                </div>
                @error('budget_min') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" name="budget_max" class="form-control" placeholder="Maximum Budget" value="{{ old('budget_max') }}">
                </div>
                @error('budget_max') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
            </div>
          </div>

          {{-- Lead Cost & No of Sales --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Lead cost</label>
              <input type="text" name="lead_cost" class="form-control" placeholder="Lead Cost" value="{{ old('lead_cost') }}">
              @error('lead_cost') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>No of Sales</label>
              <input type="number" name="stock" class="form-control" placeholder="No of Sales" value="{{ old('stock') }}">
              @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Button Text & Timeline --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Button Text</label>
              <input type="text" name="button_text" class="form-control" placeholder="Button Text (e.g., Buy Now)" value="{{ old('button_text', 'Buy Now') }}">
              @error('button_text') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>When do you need service?</label>
              <select name="service_timeframe" class="form-control">
                <option value="">Select Timeline</option>
                <option value="Immediately" {{ old('service_timeframe') == 'Immediately' ? 'selected' : '' }}>Immediately</option>
                <option value="In the next 3 days" {{ old('service_timeframe') == 'In the next 3 days' ? 'selected' : '' }}>In the next 3 days</option>
                <option value="In the next 7 days" {{ old('service_timeframe') == 'In the next 7 days' ? 'selected' : '' }}>In the next 7 days</option>
                <option value="In the next 15 days" {{ old('service_timeframe') == 'In the next 15 days' ? 'selected' : '' }}>In the next 15 days</option>
                <option value="Within a month" {{ old('service_timeframe') == 'Within a month' ? 'selected' : '' }}>Within a month</option>
                <option value="After a month" {{ old('service_timeframe') == 'After a month' ? 'selected' : '' }}>After a month</option>
              </select>
              @error('service_timeframe') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Features Needed (Full Width) --}}
          <div class="mb-3">
            <label>Features Needed</label>
            <textarea name="features_needed" class="form-control" placeholder="Enter Features Needed">{{ old('features_needed') }}</textarea>
            @error('features_needed') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Notes (Full Width) --}}
          <div class="mb-3">
            <label>Notes</label>
            <textarea name="lead_notes" class="form-control" placeholder="Enter Notes">{{ old('lead_notes') }}</textarea>
            @error('lead_notes') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Upload JPG/JPEG File --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Upload File (JPG/JPEG only)</label>
              <input type="file" name="lead_file" class="form-control" accept=".jpg,.jpeg">
              @error('lead_file')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>


          {{-- Submit Buttons --}}
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Save Lead</button>
            <a class="btn btn-secondary" href="{{ route('leads.index') }}">
              <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
@section('page-specific-javascripts')
<script src="{{ asset('assets/js/validations/leads/create.js') }}"></script>
@endsection