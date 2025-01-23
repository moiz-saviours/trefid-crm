@extends('developer.layouts.app')
@section('title','Lead Statuses')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
            href="{{route('developer.lead-status.index')}}">Lead Status</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.lead-statuses.style')
        <style>
            .status-color {
                display: inline-block;
                width: 100px;
                height: 30px;
                border: 1px solid #000;
            }
        </style>
    @endpush

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="text-center">Lead Status Table</h6>
                        <button type="button" class="btn btn-secondary float-end rounded-pill" data-bs-toggle="modal"
                                id="create-modal-btn" data-bs-target="#create-modal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="leadStatusTable" class="table table-striped" style="width: 100%">

                                <thead>
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Color</th>
                                    <th class="align-middle text-center">Description</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leadStatus as $status)
                                    <tr id="tr-{{$status->id}}">
                                        <td class="align-middle text-center">{{ $status->id }}</td>
                                        <td class="align-middle text-center">{{ $status->name }}</td>
                                        <td class="align-middle text-center">
                                            <span class="status-color" style="background-color: {{ $status->color }};"></span>
                                        </td>
                                        <td class="align-middle text-center">{{ $status->description }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status"
                                                   data-id="{{ $status->id }}"
                                                   {{ $status->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="javascript:void(0)" data-id="{{ $status->id }}"
                                               class="text-secondary editBtn" title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $status->id }}" title="Delete Record">
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

    <!-- Modal -->
    @include('developer.lead-statuses.create-modal')
    @include('developer.lead-statuses.edit-modal')

    @push('script')
        @include('developer.lead-statuses.script')
    @endpush
@endsection
