@extends('developer.layouts.app')
@section('title','Admin')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('developer.admin.account.index')}}">Admin</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.admin-accounts.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Admin Table</h3>
                        <a href="{{ route('developer.admin.account.create') }}"
                           class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="adminsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Image</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Email</th>
                                    <th class="align-middle text-center text-nowrap">Designation</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="align-middle text-center text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <tr id="tr-{{$admin->id}}">
                                        <td class="align-middle text-center text-nowrap">{{ $admin->id }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if($admin->image)
                                                @php
                                                    $imageUrl = filter_var($admin->image, FILTER_VALIDATE_URL) ? $admin->image : asset('assets/images/admins/' . $admin->image);
                                                @endphp
                                                <object
                                                    data="{{ $imageUrl }}"
                                                    class="avatar avatar-sm me-3"
                                                    title="{{ $admin->name }}"
                                                >
                                                    <img
                                                        src="{{ $imageUrl }}"
                                                        alt="{{ $admin->name }}"
                                                        class="avatar avatar-sm me-3"
                                                        title="{{ $admin->name }}">
                                                </object>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ $admin->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $admin->email }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $admin->designation }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status"
                                                   data-id="{{ $admin->id }}"
                                                   {{ $admin->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('developer.admin.account.edit', [$admin->id]) }}"
                                               class="text-secondary" title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $admin->id }}" title="Delete Record">
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
        @include('developer.admin-accounts.script')
    @endpush
@endsection
