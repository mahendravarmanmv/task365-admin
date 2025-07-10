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
                                <th>Lead ID</th>
                                <th>User Info</th>
                                <th>Provider</th>
                                <th>Status</th>
                                <th>Order Info</th>
                                <th>Lead Info</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                @php $meta = $payment->payment_meta; @endphp
                                <tr>
                                    <td>{{ $payment->lead->lead_unique_id  }}</td>

                                    {{-- User Info --}}
                                    <td>
                                        <b>Name:</b> {{ $payment->user->name ?? 'N/A' }}<br>
                                        <!--<b>Email:</b> {{ $payment->user->email ?? 'N/A' }}<br>-->
                                        <b>Phone:</b> {{ $payment->user->phone ?? $meta['phone'] ?? 'N/A' }}
                                    </td>

                                    {{-- Provider --}}
                                    <td>{{ ucfirst($meta['provider'] ?? 'N/A') }}</td>

                                    {{-- Status --}}
                                    <td>
                                        @php $statusMsg = $meta['status_msg'] ?? null; @endphp
                                        @if(str_contains(strtolower($statusMsg), 'success'))
                                            <span class="badge badge-success">{{ $statusMsg }}</span>
                                        @elseif(str_contains(strtolower($statusMsg), 'failed'))
                                            <span class="badge badge-danger">{{ $statusMsg }}</span>
                                        @elseif($statusMsg)
                                            <span class="badge badge-warning">{{ $statusMsg }}</span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>

                                    {{-- Order Info --}}
                                    <td>
                                        <b>Order ID:</b> {{ $payment->order_id ?? 'N/A' }}<br>
                                        <b>Payment ID:</b> {{ $meta['payment_id'] ?? 'N/A' }}
                                    </td>

                                    {{-- Lead Info --}}
                                    <td>
                                        <b>Name:</b> {{ $payment->lead->lead_name ?? 'N/A' }}<br>
                                        <b>Category:</b> {{ $payment->lead->category->category_title ?? 'N/A' }}
                                    </td>

                                    {{-- Amount --}}
                                    <td>₹{{ number_format($payment->amount, 2) }}</td>

                                    {{-- Date --}}
                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('jS M Y h:iA') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No payment records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-right">Total</th>
                                <th id="amountTotal" class="text-bold"></th>
                                <th></th>
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
<script type="text/javascript" src="{{ asset('assets/js/validations/payments.js') }}?v=0.1"></script>
@endsection
