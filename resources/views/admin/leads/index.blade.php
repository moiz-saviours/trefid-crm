@extends('admin.layouts.app')
@section('title', 'Leads')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
            href="{{route('admin.lead.index')}}">Lead</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.leads.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Leads Table</h3>
                        <a href="{{ route('admin.lead.create') }}" class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="leadsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Phone</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leads as $lead)
                                    <tr id="tr-{{$lead->id}}">
                                        <td class="align-middle text-center">{{ $lead->id }}</td>
                                        <td class="align-middle text-center">{{ $lead->name }}</td>
                                        <td class="align-middle text-center">{{ $lead->email }}</td>
                                        <td class="align-middle text-center">{{ $lead->phone }}</td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="badge bg-gradient-{{ $lead->status == 1 ? 'success' : 'primary' }}">
                                                {{ $lead->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('admin.lead.edit', [$lead->id]) }}"
                                               class="text-secondary" title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $lead->id }}" title="Delete Record">
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
        @include('admin.leads.script')
    @endpush
@endsection
