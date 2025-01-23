@extends('developer.layouts.app')
@section('title', 'Payment Merchants')
@section('content')
    @push('style')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    @endpush

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Payment Merchants Table</h3>
                        <a href="{{ route('developer.payment.merchant.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-0">
                            <table id="paymentMerchantsTable" class="table table-striped dataTable-213" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">ID #</th>
                                    <th class="align-middle text-center text-nowrap">Brand Key</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Vendor Name</th>
                                    <th class="align-middle text-center text-nowrap">Type</th>
                                    <th class="align-middle text-center text-nowrap">Email</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="align-middle text-center text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payment_merchants as $payment_merchant)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->id }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->brand_key }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->vendor_name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->type }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $payment_merchant->email }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <span class="badge badge-sm bg-gradient-{{ $payment_merchant->status == 'active' ? 'success' : ($payment_merchant->status == 'inactive' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($payment_merchant->status) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('developer.payment.merchant.edit', $payment_merchant->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit payment merchant">
                                                Edit
                                            </a>
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
    </div>

    @push('script')
        <!-- DataTables JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        <script>
            $(document).ready(function () {
                // $('#paymentMerchantsTable').DataTable(); // Initialize DataTable
            });
        </script>
    @endpush
@endsection
