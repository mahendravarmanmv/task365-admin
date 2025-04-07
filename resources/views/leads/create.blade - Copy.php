@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Lead</h2>
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="lead_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="lead_email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="lead_phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Notes</label>
            <textarea name="lead_notes" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
