@extends('admin.layouts.app')
@section('title','Invoices')
@section('datatable', true)
@section('content')
    @push('style')
        @include('admin.invoices.style')
    @endpush
    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <header class="custm_header">
                    <div class="new_head">
                        <h1 class="page-title mb-2">Invoices <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <h2 id="record-count" class="h6">{{count($invoices)}} records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                            <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn">Import</button>
                            <button class="create-contact open-form-btn">Create New</button>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="container">
                    <div class="custom-tabs">
                        <ul class="tab-nav">
                            <li class="tab-item active" data-tab="home">Invoices
                                <i class="fa fa-times close-icon" aria-hidden="true"></i></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="card">
                                <div class="card-header">
                                    <div class="container">
                                        <div class="row fltr-sec">
                                            <div class="col-md-8">
                                                <ul class="custm-filtr">
                                                    <div class="table-li">
                                                        <li class="">Company Owner <i class="fa fa-caret-down"
                                                                                      aria-hidden="true"></i></li>
                                                        <li class="">Create date <i class="fa fa-caret-down"
                                                                                    aria-hidden="true"></i></li>
                                                        <li class="">Last activity date <i class="fa fa-caret-down"
                                                                                           aria-hidden="true"></i>
                                                        </li>
                                                        <li class="">Lead status <i class="fa fa-caret-down"
                                                                                    aria-hidden="true"></i></li>
                                                        <li class=""><i class="fa fa-bars" aria-hidden="true"></i> All
                                                            filters
                                                        </li>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 right-icon" id="right-icon-0"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="allInvoicesTable" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap
                            initTable
                            ">
                                        <thead>

                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th class="align-middle text-center text-nowrap">SNO.</th>
                                            <th class="align-middle text-center text-nowrap">INVOICE #</th>
                                            <th class="align-middle text-center text-nowrap">BRAND</th>
                                            <th class="align-middle text-center text-nowrap">TEAM</th>
                                            <th class="align-middle text-center text-nowrap">CLIENT</th>
                                            <th class="align-middle text-center text-nowrap">AGENT</th>
                                            <th class="align-middle text-center text-nowrap">AMOUNT</th>
                                            <th class="align-middle text-center text-nowrap">STATUS</th>
                                            <th class="align-middle text-center text-nowrap">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr id="tr-{{$invoice->id}}">
                                                <td class="align-middle text-center text-nowrap"></td>
                                                <td class="align-middle text-center text-nowrap">{{$loop->iteration}}</td>
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
                                                    <input type="checkbox" class="status-toggle change-status"
                                                           data-id="{{ $invoice->id }}"
                                                           {{ $invoice->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                                </td>
                                                <td class="align-middle text-center table-actions">
                                                    <button type="button" class="btn btn-sm btn-primary editBtn"
                                                            data-id="{{ $invoice->id }}" title="Edit"><i
                                                                class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                                            data-id="{{ $invoice->id }}" title="Delete"><i
                                                                class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.invoices.custom-form')
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    @push('script')
        @include('admin.invoices.script')
    @endpush
@endsection
