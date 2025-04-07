@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        @if($category->category_image)
                            <img src="{{ asset('storage/' . $category->category_image) }}" width="50">
                        @endif
                    </td>
                    <td>{{ $category->category_title }}</td>
                    <td>{{ $category->category_description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
