@extends('admin.layouts.app')
@section('title','Payments')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('admin.payment.index')}}">Payment</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.payments.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Payments Table</h3>
                        <a href="{{ route('admin.payment.create') }}" class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="paymentsTable" class="table table-striped dataTable-213" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id #</th>
                                    <th class="align-middle text-center text-nowrap">Invoice #</th>
                                    <th class="align-middle text-center text-nowrap">Brand</th>
                                    <th class="align-middle text-center text-nowrap">Team</th>
                                    <th class="align-middle text-center text-nowrap">Agent</th>
                                    <th class="align-middle text-center text-nowrap">Amount</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap">{{$payment->id}}</td>
                                        <td class="align-middle text-center text-nowrap text-sm">
                                            {{ optional($payment->invoice)->invoice_number }}
                                            <br> {{ optional($payment->invoice)->invoice_key }}
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($payment->brand)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($payment->team)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ optional($payment->agent)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ number_format($payment->amount, 2) }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <span
                                                class="badge badge-sm bg-gradient-{{ $payment->status == 0 ? 'primary' : ($payment->status == 1 ? 'success' : 'danger') }}">
                                                {{ $payment->status == 0 ? 'Due' : ($payment->status == 1 ? 'Paid' : 'Refund') }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{route('admin.payment.edit',[$payment->id])}}" data-id="{{ $payment->id }}"
                                               class="text-secondary editBtn" title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
{{--                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"--}}
{{--                                               data-id="{{ $payment->id }}" title="Delete Record">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
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
        @include('admin.payments.script')
    @endpush
@endsection
