@extends('admin.layouts.app')
@section('title','Employees')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('admin.employee.index')}}">Employee</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.employees.style')
        <style>
            td.align-middle.text-center.text-nowrap.editable:hover select{
                border: 1px solid #000;
                border-radius: 5px;
            }
            td.align-middle.text-center.text-nowrap.editable[data] , td.align-middle.text-center.text-nowrap.editable{
                cursor:pointer;
            }
            .void {
                cursor: not-allowed;
            }

            .custm_header {
                padding: 10px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .actions {
                display: flex;
            }

            .actions h1 {
                margin: auto;
                color: #52a0bf;
                font-size: 15px;
            }

            .filters,
            .table-controls {
                display: flex;
                justify-content: space-between;
                padding: 10px 20px;
                border-bottom: 1px solid #ddd;
            }

            .filters .filter-tabs button,
            .actions button {
                padding: 5px 12px;
                border: 1px solid #ff5722;
                border-radius: 4px;
                background-color: #fff;
                cursor: pointer;
            }

            .filters .actions .create-contact {
                background-color: #ff5722;
                color: #fff;
                border: none;
            }

            .search-bar input {
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                width: 250px;
            }

            .contacts-table {
                width: 100%;
                border-collapse: collapse;
            }

            .contacts-table th,
            .contacts-table td {
                padding: 10px;
                text-align: left;
                /*border: 1px solid #ddd;*/
            }

            .contacts-table th {
                /*background-color: #f1f5f9;*/
                font-weight: bold;
            }

            .contacts-table tbody tr:hover {
                background-color: #f9f9f9;
            }


            .header .new_head h1 {
                font-size: 20px;
                color: #52a0bf;
                font-weight: 700;

            }

            .header_btn {
                padding: 0px 30px;
                color: #ff5722;
                margin: 0px 10px;
            }

            .custom-tabs {
                margin: 10px 0px;
                display: flex;
            }

            .tab-nav {
                display: flex;
                justify-content: space-around;
                list-style: none;
                padding: 0;
                margin: 0;
                width: 70%;
            }

            .tab-buttons {
                margin-left: 100px;
            }

            .tab-item {
                padding: 10px 20px;
                cursor: pointer;
                border: 1px solid #cbd6e2;
                background: #f9f9f9;
                width: 100%;
                transition: background 0.3s ease;
            }

            .tab-item.active {
                background: #fff;
                border-bottom: none;

            }

            .tab-item.active i {
                float: right;
                font-size: 14px;
                margin: auto;
            }

            .tab-content {
                /*padding: 10px;*/
                /*margin-top: 10px;*/
            }

            .tab-pane {
                display: none;
            }

            .tab-pane.active {
                display: block;

            }

            .fltr-sec {
                padding-top: 20px;
            }

            .table-li {
                display: flex;
            }

            .table-li .page-title {
                font-size: 14px;
                padding: 0px 30px 0px 0px;

                font-weight: 700;
            }

            .right-icon i {
                float: right;
                margin: 0px 4px;
                border: 1px solid #ccc;
                padding: 5px;
                border-radius: 5px;
                font-size: 12px;
            }

            .custom-form .form-container {
                position: fixed;
                top: 0;
                right: -100%;
                width: 500px;
                height: 100%;
                background: #ffffff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                transition: right 0.5s ease;
                box-sizing: border-box;
                z-index: 1001;
            }

            .custom-form .form-container.open {
                right: 0;
            }

            .custom-form .form-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 20px;
                background: #52a0bf;
                color: white;
                font-size: 18px;
                font-weight: bold;
            }

            .custom-form .form-header .close-btn {
                font-size: 20px;
                font-weight: bold;
                background: none;
                border: none;
                color: white;
                cursor: pointer;
            }

            .custom-form .form-body {
                padding: 20px;
            }

            .custom-form .form-body label {
                display: block;
                margin-bottom: 5px;
                font-weight: 500;
            }

            .custom-form .form-body input {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .custom-form .form-body button {
                width: 100%;
                padding: 10px;
                background: #52a0bf;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .close-icon {
                display: none;
            }

            .tab-item.active .close-icon {
                display: inline;
            }

        </style>
    @endpush
{{--    <div class="container-fluid py-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card mb-4">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h3 class="text-center">Employee Table</h3>--}}
{{--                        <a href="{{ route('admin.employee.create') }}" class="btn btn-secondary float-end rounded-pill"><i--}}
{{--                                class="fas fa-plus"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="card-body px-0 pt-0 pb-2">--}}
{{--                        <div class="table table-responsive p-3">--}}
{{--                            <table id="employeesTable" class="table table-striped" style="width: 100%">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Id</th>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Image</th>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Name</th>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Designation</th>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Status</th>--}}
{{--                                    <th class="align-middle text-center text-nowrap">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    <tr id="tr-{{$user->id}}">--}}
{{--                                        <td class="align-middle text-center text-nowrap">{{ $user->id }}</td>--}}
{{--                                        <td class="align-middle text-center text-nowrap">--}}
{{--                                            @php--}}
{{--                                                $imageUrl = filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('assets/images/employees/' . $user->image);--}}
{{--                                            @endphp--}}
{{--                                            <object--}}
{{--                                                data="{{ $imageUrl }}"--}}
{{--                                                class="avatar avatar-sm me-3"--}}
{{--                                                title="{{ $user->name }}"--}}
{{--                                            >--}}
{{--                                                <img--}}
{{--                                                    src="{{ $imageUrl }}"--}}
{{--                                                    alt="{{ $user->name }}"--}}
{{--                                                    class="avatar avatar-sm me-3"--}}
{{--                                                    title="{{ $user->name }}">--}}
{{--                                            </object>--}}
{{--                                        </td>--}}
{{--                                        <td class="align-middle text-center text-nowrap">{{ $user->name }}</td>--}}
{{--                                        <td class="align-middle text-center text-nowrap">{{ $user->designation }}</td>--}}
{{--                                        <td class="align-middle text-center text-nowrap">--}}
{{--                                            <input type="checkbox" class="status-toggle change-status" data-id="{{ $user->id }}"--}}
{{--                                                   {{ $user->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">--}}
{{--                                        </td>--}}
{{--                                        <td class="align-middle text-center table-actions">--}}
{{--                                            <a href="{{ route('admin.employee.edit', [$user->id]) }}"--}}
{{--                                               class="text-secondary" title="Edit Employee">--}}
{{--                                                <i class="fas fa-edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"--}}
{{--                                               data-id="{{ $user->id }}" title="Delete Employee">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <header class="custm_header">
                    <div class="new_head">
                        <h1 class="page-title mb-2">Employees <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <h2 id="record-count" class="h6">{{count($users)}} records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                            <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn">Import</button>
                            <button class="create-contact open-form-btn ">Create New</button>
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
                            <li class="tab-item active" data-tab="home">Employees
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
                                    <table id="allUsersTable" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap
                            initTable
                            ">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
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
                                        <td class="align-middle text-center text-nowrap"></td>
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
                                                    style="width: 100px; height: 50px;"
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
                                            <a href="{{ route('admin.employee.edit', [$user->id]) }}"
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

                    <div class="custom-form">
                        <div class="form-container" id="formContainer">
                            <!-- Form Header -->
                            <div class="form-header">
                                Add Company
                                <button class="close-btn">×</button>
                            </div>
                            <!-- Form Body -->
                            <div class="form-body">
                                <label for="name">Company Name</label>
                                <input type="text" id="name" placeholder="Enter your name">
                                <label for="email">Company Domain</label>
                                <input type="email" id="email" placeholder="Enter your email">
                                <button>Submit</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


    @push('script')
        @include('admin.employees.script')
    @endpush
@endsection
