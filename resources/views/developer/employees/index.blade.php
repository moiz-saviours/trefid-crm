@extends('developer.layouts.app')
@section('title','Employees')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('developer.employee.index')}}">Employee</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.employees.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Employee Table</h3>
                        <a href="{{ route('developer.employee.create') }}" class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="employeesTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Image</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Designation</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class="align-middle text-center text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr id="tr-{{$user->id}}">
                                        <td class="align-middle text-center text-nowrap">{{ $user->id }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            @php
                                                $imageUrl = filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('assets/images/employees/' . $user->image);
                                            @endphp
                                            <object
                                                data="{{ $imageUrl }}"
                                                class="avatar avatar-sm me-3"
                                                title="{{ $user->name }}"
                                            >
                                                <img
                                                    src="{{ $imageUrl }}"
                                                    alt="{{ $user->name }}"
                                                    class="avatar avatar-sm me-3"
                                                    title="{{ $user->name }}">
                                            </object>
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ $user->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $user->designation }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status" data-id="{{ $user->id }}"
                                                   {{ $user->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('developer.employee.edit', [$user->id]) }}"
                                               class="text-secondary" title="Edit Employee">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $user->id }}" title="Delete Employee">
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
        @include('developer.employees.script')
    @endpush
@endsection
