@extends('admin.layouts.app')
@section('title','Brands')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a href="{{route('admin.brand.index')}}">Brand</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.brands.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="text-center">Brand Table</h6>
                        <button type="button" class="btn btn-secondary float-end rounded-pill" data-bs-toggle="modal"
                                id="create-modal-btn" data-bs-target="#create-modal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="brandsTable" class="table table-striped datatable-exportable"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Logo</th>
                                    <th class="align-middle text-center text-nowrap">Brand Key</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Url</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $key => $brand)
                                    <tr id="tr-{{$brand->id}}">
                                        <td class="align-middle text-center text-nowrap">{{$brand->id}}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            @php
                                                $logoUrl = filter_var($brand->logo, FILTER_VALIDATE_URL) ? $brand->logo : asset('assets/images/brand-logos/'.$brand->logo);
                                            @endphp
                                            <object
                                                data="{{ $logoUrl }}"
                                                class="avatar avatar-sm me-3"
                                                title="{{ $brand->name }}"
                                            >
                                                <img
                                                    src="{{ $logoUrl }}"
                                                    alt="{{ $brand->name }}"
                                                    class="avatar avatar-sm me-3"
                                                    title="{{ $brand->name }}">
                                            </object>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{$brand->brand_key}}</td>
                                        <td class="align-middle text-center text-nowrap">{{$brand->name}}
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{$brand->url}}
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status" data-id="{{ $brand->id }}"
                                                   {{ $brand->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="javascript:void(0)" data-id="{{ $brand->id }}"
                                               class="text-secondary editBtn" title="Edit Brand">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $brand->id }}" title="Delete Brand">
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
    @include('admin.brands.create-modal')
    @include('admin.brands.edit-modal')

    @push('script')
        @include('admin.brands.script')
    @endpush
@endsection
