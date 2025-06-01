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
        <form action="{{ route('leads.update', $lead->id) }}" method="POST">
          @csrf
          @method('PUT')

          {{-- Category --}}
          <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
              <option value="">Select Category</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id', $lead->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->category_title }}
              </option>
              @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Name --}}
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="lead_name" placeholder="Enter Lead Name" class="form-control" value="{{ old('lead_name', $lead->lead_name) }}">
            @error('lead_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Email --}}
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="lead_email" placeholder="Enter Lead Email" class="form-control" value="{{ old('lead_email', $lead->lead_email) }}">
            @error('lead_email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Phone --}}
          <div class="mb-3">
            <label>Mobile</label>
            <input type="text" name="lead_phone" placeholder="Enter Lead Monile number" class="form-control" value="{{ old('lead_phone', $lead->lead_phone) }}">
            @error('lead_phone')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Location --}}
          <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" placeholder="Enter Location" value="{{ old('location', $lead->location) }}">
            @error('location')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Business Name --}}
          <div class="mb-3">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" placeholder="Enter Business Name" value="{{ old('business_name', $lead->business_name) }}">
            @error('business_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Industry/Niche --}}
          <div class="mb-3">
            <label>Industry / Niche</label>
            <input type="text" name="industry" class="form-control" placeholder="Enter Industry or Niche" value="{{ old('industry', $lead->industry) }}">
            @error('industry')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Website Type --}}
          <div class="mb-3">
            <label>Website Type</label>
            <select name="website_type" class="form-control">
              <option value="">Select Website Type</option>
              @foreach (['Small Business Website', 'Startup Website', 'Personal Website', 'Blogging Website', 'E-Commerce Website', 'Real Estate Website', 'Others'] as $option)
              <option value="{{ $option }}" {{ old('website_type', $lead->website_type) == $option ? 'selected' : '' }}>
                {{ $option }}
              </option>
              @endforeach
            </select>
            @error('website_type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Features Needed --}}
          <div class="mb-3">
            <label>Features Needed</label>
            <textarea name="features_needed" class="form-control" placeholder="Describe the features needed">{{ old('features_needed', $lead->features_needed) }}</textarea>
            @error('features_needed')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Reference Website --}}
          <div class="mb-3">
            <label>Reference Website</label>
            <input type="text" name="reference_website" class="form-control" placeholder="Enter Reference Website URL" value="{{ old('reference_website', $lead->reference_website) }}">
            @error('reference_website')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Budget Range --}}
          <div class="mb-3">
            <label>Client Budget Range</label>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" name="budget_min" class="form-control" placeholder="Minimum Budget" value="{{ old('budget_min', $lead->budget_min) }}">
                </div>
                @error('budget_min')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" name="budget_max" class="form-control" placeholder="Maximum Budget" value="{{ old('budget_max', $lead->budget_max) }}">
                </div>
                @error('budget_max')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          {{-- Lead Cost --}}
          <div class="mb-3">
            <label>Lead Cost</label>
            <input type="text" name="lead_cost" class="form-control" placeholder="Lead Cost" value="{{ old('lead_cost', $lead->lead_cost) }}">
            @error('lead_cost')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>


          {{-- When do you need service --}}
          <div class="mb-3">
            <label>When do you need service?</label>
            <select name="service_timeframe" class="form-control">
              <option value="">Select Timeframe</option>
              @foreach (['Immediately', 'In the next 3 days', 'In the next 7 days', 'In the next 15 days', 'Within a month', 'After a month'] as $option)
              <option value="{{ $option }}" {{ old('service_timeframe', $lead->service_timeframe) == $option ? 'selected' : '' }}>
                {{ $option }}
              </option>
              @endforeach
            </select>
            @error('service_timeframe')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Notes --}}
          <div class="mb-3">
            <label>Notes</label>
            <textarea name="lead_notes" class="form-control" placeholder="Additional Notes">{{ old('lead_notes', $lead->lead_notes) }}</textarea>
            @error('lead_notes')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          {{-- Submit --}}
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Lead</button>
            <a class="btn btn-secondary" href="{{ route('leads.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection