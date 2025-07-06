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
        <div class="mb-4">
          <h5>Lead Unique ID: <span class="text-success">{{ $lead->lead_unique_id }}</span></h5>
        </div>
        <form action="{{ route('leads.update', $lead->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Category and Website Type --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Category</label>
              <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $lead->category_id) == $category->id ? 'selected' : '' }}>
                  {{ $category->category_title }}
                </option>
                @endforeach
              </select>
              @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Website Type</label>
              <select name="website_type" class="form-control" id="websiteTypeSelect">
                <option value="">Select Website Type</option>
              </select>
              @error('website_type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Name and Email --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Name</label>
              <input type="text" name="lead_name" placeholder="Enter Lead Name" class="form-control" value="{{ old('lead_name', $lead->lead_name) }}">
              @error('lead_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Email</label>
              <input type="email" name="lead_email" placeholder="Enter Lead Email" class="form-control" value="{{ old('lead_email', $lead->lead_email) }}">
              @error('lead_email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Phone and Location --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Mobile</label>
              <input type="text" name="lead_phone" placeholder="Enter Lead Mobile number" class="form-control" value="{{ old('lead_phone', $lead->lead_phone) }}">
              @error('lead_phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Location</label>
              <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{ old('location', $lead->location) }}">
              @error('location') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Business Name and Reference Website --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Business Name</label>
              <input type="text" name="business_name" class="form-control" placeholder="Enter Business Name" value="{{ old('business_name', $lead->business_name) }}">
              @error('business_name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Reference Website</label>
              <input type="text" name="reference_website" class="form-control" placeholder="Enter Reference Website" value="{{ old('reference_website', $lead->reference_website) }}">
              @error('reference_website') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Budget Min & Max --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Minimum Budget</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="budget_min" class="form-control" placeholder="Minimum Budget" value="{{ old('budget_min', $lead->budget_min) }}">
              </div>
              @error('budget_min') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>Maximum Budget</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="budget_max" class="form-control" placeholder="Maximum Budget" value="{{ old('budget_max', $lead->budget_max) }}">
              </div>
              @error('budget_max') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Lead Cost & Stock --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Lead Cost</label>
              <input type="text" name="lead_cost" class="form-control" placeholder="Lead Cost" value="{{ old('lead_cost', $lead->lead_cost) }}">
              @error('lead_cost') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>No of Sales</label>
              <input type="number" name="stock" class="form-control" placeholder="No of Sales" value="{{ old('stock', $lead->stock) }}">
              @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Button Text & Service Timeframe --}}
          <div class="row mb-3">
            <div class="col-md-6">
              <label>Button Text</label>
              <input type="text" name="button_text" class="form-control" placeholder="Button Text" value="{{ old('button_text', $lead->button_text ?? 'Buy Now') }}">
              @error('button_text') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
              <label>When do you need service?</label>
              <select name="service_timeframe" class="form-control">
                <option value="">Select Timeframe</option>
                @foreach (['Immediately', 'In the next 3 days', 'In the next 7 days', 'In the next 15 days', 'Within a month', 'After a month'] as $option)
                <option value="{{ $option }}" {{ old('service_timeframe', $lead->service_timeframe) == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
              </select>
              @error('service_timeframe') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
          </div>

          {{-- Features Needed --}}
          <div class="mb-3">
            <label>Features Needed</label>
            <textarea name="features_needed" class="form-control" placeholder="Describe the features needed">{{ old('features_needed', $lead->features_needed) }}</textarea>
            @error('features_needed') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- Notes --}}
          <div class="mb-3">
            <label>Notes</label>
            <textarea name="lead_notes" class="form-control" placeholder="Additional Notes">{{ old('lead_notes', $lead->lead_notes) }}</textarea>
            @error('lead_notes') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          {{-- File Upload --}}
          <div class="mb-3">
    <label class="form-label">Uploaded Image (JPG/JPEG Only)</label>
    <input type="file" name="lead_file" class="form-control">
    @error('lead_file') <span style="color: red;">{{ $message }}</span> @enderror

    @if(isset($lead) && $lead->lead_file)
        <img src="{{ asset('storage/' . $lead->lead_file) }}" width="100" class="mt-2 border rounded">
    @endif
</div>



          {{-- Submit --}}
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Lead</button>
            <a class="btn btn-secondary" href="{{ route('leads.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i> Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-specific-javascripts')
<input type="hidden" id="selectedWebsiteTypeId" value="{{ old('website_type', $lead->website_type) }}">
<input type="hidden" id="initialCategoryId" value="{{ old('category_id', $lead->category_id) }}">
<script src="{{ asset('assets/js/validations/leads/edit.js') }}?v=0.1"></script>
@endsection