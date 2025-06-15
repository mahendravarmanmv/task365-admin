@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Website Types</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Website Types</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <p><a class="btn btn-primary icon-btn" href="{{ route('website-types.create') }}"><i class="fa fa-plus"></i> Add Website Type</a></p>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Website Type</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $index => $type)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ strtoupper($type->category->category_title) }}</td>
                                <td>{{ $type->type_title }}</td>
                                <td>{{ $type->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{ route('website-types.edit', $type->id) }}"><i class="fa fa-lg fa-edit"></i></a>
                                        <form action="{{ route('website-types.destroy', $type->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this website type?')"><i class="fa fa-lg fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- .table-responsive -->
            </div> <!-- .tile-body -->
        </div> <!-- .tile -->
    </div> <!-- .col-md-12 -->
</div> <!-- .row -->
@endsection

@section('page-specific-javascripts')
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable();
</script>
@endsection
