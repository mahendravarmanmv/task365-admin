@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leads</h2>
    <a href="{{ route('leads.create') }}" class="btn btn-primary">Add Lead</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leads as $lead)
            <tr>
                <td>{{ $lead->id }}</td>
                <td>{{ $lead->category->category_title }}</td>
                <td>{{ $lead->lead_name }}</td>
                <td>{{ $lead->lead_email }}</td>
                <td>{{ $lead->lead_phone }}</td>
                <td>{{ $lead->lead_notes }}</td>
                <td>
                    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
