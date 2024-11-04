@extends('admin.layouts.app')
@section('title', 'Invoices')
@section('content')
    @push('style')
        <!-- DataTables CSS -->
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">--}}
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    @endpush

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Invoices Table</h3>
                        <a href="{{ route('admin.invoice.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-0">
                            <table id="invoicesTable" class="table table-striped dataTable-213" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id #</th>
                                    <th class="align-middle text-center text-nowrap">Brand Key</th>
                                    <th class="align-middle text-center text-nowrap">Team Key</th>
                                    <th class="align-middle text-center text-nowrap">Agent ID</th>
                                    <th class="align-middle text-center text-nowrap">Amount</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap text-sm">
                                            {{ $invoice->invoice_number }} <br> {{ $invoice->invoice_key }}
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($invoice->brand)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($invoice->team)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($invoice->agent)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ number_format($invoice->amount, 2) }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <span class="badge badge-sm bg-gradient-{{ $invoice->status == 1 ? 'success' : 'primary' }}">
                                                {{ $invoice->status == 1 ? 'Paid' : 'Due' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.invoice.edit', $invoice->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit invoice">
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
                // $('#invoicesTable').DataTable(); // Initialize DataTable
            });
        </script>
    @endpush
@endsection
