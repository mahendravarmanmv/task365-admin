@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Vendors</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Vendors</li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>WA</th>
                                <th>B Proof</th>
                                <th>I Proof</th>
                                <th>Approval</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->id }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->company_name }}</td>
                                <td>{{ $vendor->phone }}</td>
                                <td>{{ $vendor->whatsapp_number }}</td>
                                <td>
                                    @if($vendor->business_proof)
                                    <a href="{{ config('app.domain') . '/storage/' . $vendor->business_proof }}" target="_blank">View</a>
                                    @endif
                                </td>
                                <td>
                                    @if($vendor->identity_proof)
                                    <a href="{{ config('app.domain') . '/storage/' . $vendor->identity_proof }}" target="_blank">View</a>
                                    @endif
                                </td>
                                <td>
                                    @if($vendor->approved)
                                    <span class="badge bg-success">Approved</span>
                                    @else
                                    <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary"><i class="fa fa-lg fa-edit"></i></a>
                                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-lg fa-trash"></i></button>
                                    </form>
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
    $('#sampleTable').DataTable();
</script>
@endsection