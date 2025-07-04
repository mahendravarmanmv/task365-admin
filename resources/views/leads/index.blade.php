@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Leads</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Leads</li>
    </ul>
</div>
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <p><a class="btn btn-primary icon-btn" href="{{ route('leads.create') }}"><i class="fa fa-plus"></i>Add Lead</a></p>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Lead Unique ID</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Lead Cost</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong class="text-success">{{ $lead->lead_unique_id }}</strong></td>
                                <td>{{ $lead->category->category_title }}</td>
                                <td>{{ $lead->lead_name }}</td>
                                <td>{{ $lead->lead_email }}</td>
                                <td>{{ $lead->lead_phone }}</td>
                                <td>₹ {{ $lead->lead_cost }}</td>
                                <td>{{ $lead->stock }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{ route('leads.edit', $lead->id) }}"><i class="fa fa-lg fa-edit"></i></a>
                                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-lg fa-trash"></i></button>
                                        </form>
                                    </div>


                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-specific-javascripts')
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable({
    order: [[1, 'desc']], // Sort by second column (Lead Unique ID)
    columnDefs: [
        {
            targets: 0, // first column (S.No)
            orderable: false // disable sorting
        }
    ]
});

</script>
@endsection