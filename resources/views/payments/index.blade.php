@extends('layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> Payments</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Payments</li>
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
                                <th>Email</th>
                                <th>Lead Name</th>
                                <th>Lead Category</th>
                                <th>Amount</th>
                                <th>Payment ID</th>
                                <th>Order ID</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->email }}</td>
                                <td>{{ $payment->lead->lead_name ?? 'N/A' }}</td>
                                <td>{{ $payment->lead->category->category_title ?? 'N/A' }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_id ?? 'N/A' }}</td>
                                <td>{{ $payment->order_id ?? 'N/A' }}</td>
                                <td>
                                    @if($payment->status)
                                    <b class="text-success">Paid</b>
                                    @else
                                    <b class="text-danger">Pending</b>
                                    @endif
                                </td>
                                <td>{{ $payment->created_at->format('jS M Y gA') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No payment records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th id="amountTotal"></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
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
<script type="text/javascript" src="{{ asset('assets/js/validations/payments.js') }}"></script>
@endsection
