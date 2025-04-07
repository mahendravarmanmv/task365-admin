@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Users List</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Business Proof</th>
                <th>Identity Proof</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->company_name }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if($user->business_proof)
                        <a href="{{ asset('storage/' . $user->business_proof) }}" target="_blank">View</a>
                    @endif
                </td>
                <td>
                    @if($user->identity_proof)
                        <a href="{{ asset('storage/' . $user->identity_proof) }}" target="_blank">View</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection