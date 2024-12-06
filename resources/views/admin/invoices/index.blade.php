@extends('admin.layouts.app')
@section('title','Invoices')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
            href="{{route('admin.invoice.index')}}">Invoice</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.invoices.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Invoices Table</h3>
                        <a href="{{ route('admin.invoice.create') }}"
                           class="btn btn-secondary float-end rounded-pill"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="invoicesTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Invoice #</th>
                                    <th class="align-middle text-center text-nowrap">Brand</th>
                                    <th class="align-middle text-center text-nowrap">Team</th>
                                    <th class="align-middle text-center text-nowrap">Client</th>
                                    <th class="align-middle text-center text-nowrap">Agent</th>
                                    <th class="align-middle text-center text-nowrap">Amount</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $key => $invoice)
                                    <tr id="tr-{{$invoice->id}}">
                                        <td class="align-middle text-center text-nowrap">{{ $invoice->id }}</td>
                                        <td class="align-middle text-center text-nowrap text-sm invoice-cell">
                                            <span class="invoice-number">{{ $invoice->invoice_number }}</span><br>
                                            <span class="invoice-key">{{ $invoice->invoice_key }}</span>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($invoice->brand))
                                                <a href="{{route('admin.brand.edit',[$invoice->brand->id])}}">{{ $invoice->brand->name }}</a>
                                                <br> {{ $invoice->brand->brand_key }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($invoice->team))
                                                <a href="{{route('admin.team.edit',[$invoice->team->id])}}">{{ $invoice->team->name }}</a>
                                                <br> {{ $invoice->team->team_key }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($invoice->client))
                                                <a href="{{route('admin.client.edit',[$invoice->client->id])}}">{{ $invoice->client->name }}</a>
                                                <br> {{ $invoice->client->client_key }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($invoice->agent))
                                                <a href="{{route('admin.employee.edit',[$invoice->agent->id])}}">{{ $invoice->agent->name }}</a>
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ number_format($invoice->amount, 2) }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <span
                                                class="badge badge-sm bg-gradient-{{ $invoice->status == 1 ? 'success' : 'primary' }}">
                                                {{ $invoice->status == 1 ? 'Paid' : 'Due' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('admin.invoice.edit', [$invoice->id]) }}"
                                               class="text-secondary" title="Edit Invoice">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $invoice->id }}" title="Delete Invoice">
                                                <i class="fas fa-trash"></i>
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
        @include('admin.invoices.script')
    @endpush
@endsection
