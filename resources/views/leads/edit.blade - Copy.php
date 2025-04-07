@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Lead</h2>
    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $lead->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->category_title }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="lead_name" class="form-control" value="{{ $lead->lead_name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="lead_email" class="form-control" value="{{ $lead->lead_email }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="lead_phone" class="form-control" value="{{ $lead->lead_phone }}">
        </div>
        <div class="mb-3">
            <label>Notes</label>
            <textarea name="lead_notes" class="form-control">{{ $lead->lead_notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('leads.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
