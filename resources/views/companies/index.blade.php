@extends('layouts.app')
@section('title','Companies')
@section('datatable', true)
@section('content')
    @push('style')
        @include('companies.style')
        <style>
            .container {
                width: 100%;
                margin: 20px auto;
                background: #fff;
                border-radius: 6px;
                overflow: hidden;
            }

            .header {
                padding: 10px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .header h1 {
                font-size: 18px;
                color: #333;
            }

            .record-count {
                font-size: 14px;
                color: #000;
                font-weight: 600;
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
                border: 1px solid #ddd;
            }

            .contacts-table th {
                background-color: #f1f5f9;
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
            }

            .tab-nav {
                display: flex;
                justify-content: space-around;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .tab-item {
                padding: 10px 20px;
                cursor: pointer;
                border: 1px solid #ccc;
                background: #f9f9f9;
                width: 100%;
                transition: background 0.3s ease;
            }

            .tab-item.active {
                background: #fff;
                border-bottom: none;

            }

            .tab-content {
                border: 2px solid #ccc;
                padding: 15px;
                margin-top: 10px;
                background: #fff;
            }

            .tab-pane {
                display: none;
            }

            .tab-pane.active {
                display: block;

            }

            .fltr-sec {
                padding: 20px 0px;
            }
            .table-li {
                display: flex;
            }
            .table-li li {
                font-size: 14px;
                padding: 0px 30px 0px 0px;
                color: #52a0bf;
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

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                visibility: hidden;
                opacity: 0;
                transition: opacity 0.5s ease, visibility 0.5s ease;
                z-index: 9;
            }

            .overlay.active {
                visibility: visible;
                opacity: 1;
            }



            .form-container {
                position: fixed;
                top: 0;
                right: -100%;
                width: 500px;
                height: 100%;
                background: #ffffff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                transition: right 0.5s ease;
                box-sizing: border-box;
                z-index: 99;
            }

            .form-container.open {
                right: 0;
            }

            .form-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px 20px;
                background: #52a0bf;
                color: white;
                font-size: 18px;
                font-weight: bold;
            }

            .form-header .close-btn {
                font-size: 20px;
                font-weight: bold;
                background: none;
                border: none;
                color: white;
                cursor: pointer;
            }

            .form-header .close-btn:hover {
                color: #ddd;
            }

            .form-body {
                padding: 20px;
            }

            .form-body label {
                display: block;
                margin-bottom: 5px;
                font-weight: 500;
            }

            .form-body input {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .form-body button {
                width: 100%;
                padding: 10px;
                background: #52a0bf;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .form-body button:hover {
                background: #52a0bf;
            }

            .open-form-btn {
                padding: 10px 20px;
                background: #52a0bf;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .open-form-btn:hover {
                background: #52a0bf;
            }
        </style>
    @endpush
    <section id="content" class="content">
        <div class="container">
            <header class="header">
                <div class="new_head">
                    <h1>Companies <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                    <span class="record-count">14,500 records</span>
                </div>
                <div class="filters">
                    <div class="actions">
                        <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                        <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                        <button class="header_btn">Import</button>
                        <button class="create-contact open-form-btn">Create Companies</button>
                    </div>
                </div>
            </header>

            <div class="custom-tabs">
                <ul class="tab-nav">
                    <li class="tab-item active" data-tab="home">All Companies</li>
                    <li class="tab-item" data-tab="menu1">My Companies</li>
                </ul>
            </div>


            <div class="container">
                <div class="row fltr-sec">
                    <div class="col-md-8">
                        <ul class="custm-filtr">
                            <div class="table-li">
                                <li>Compnay Owner <i class="fa fa-caret-down" aria-hidden="true"></i></li>
                                <li>Create date <i class="fa fa-caret-down" aria-hidden="true"></i></li>
                                <li>Last activity date <i class="fa fa-caret-down" aria-hidden="true"></i></li>
                                <li>Lead status <i class="fa fa-caret-down" aria-hidden="true"></i></li>
                                <li> <i class="fa fa-bars" aria-hidden="true"></i> All filters </li>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="right-icon">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                            <i class="fa fa-clone" aria-hidden="true"></i>
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <table class="contacts-table">
                        <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>CONTACT OWNER</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Example rows -->
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><a href="">New Company</a></td>
                            <td>new@gmail.com</td>
                            <td>+00 000 0000 0000</td>
                            <td>Hussain Khan</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="menu1">
                    <table id="companiesTable" class="table table-striped datatable-exportable"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th class="align-middle text-center text-nowrap">S.No#</th>
                            <th class="align-middle text-center text-nowrap">Logo</th>
                            <th class="align-middle text-center text-nowrap">Name</th>
                            <th class="align-middle text-center text-nowrap">Url</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $key => $company)
                            <tr id="tr-{{$company->id}}">
                                <td class="align-middle text-center text-nowrap">{{$key + 1}}
                                <td class="align-middle text-center text-nowrap">
                                    @php
                                        $logoUrl = filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : asset('assets/images/company-logos/'.$company->logo);
                                    @endphp
                                    <object
                                        data="{{ $logoUrl }}"
                                        class="avatar avatar-sm me-3"
                                        title="{{ $company->name }}"
                                    >
                                        <img
                                            src="{{ $logoUrl }}"
                                            alt="{{ $company->name }}"
                                            class="avatar avatar-sm me-3"
                                            title="{{ $company->name }}">
                                    </object>
                                </td>
                                <td class="align-middle text-center text-nowrap">{{$company->name}}
                                </td>
                                <td class="align-middle text-center text-nowrap">{{$company->url}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overlay" id="overlay"></div>

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
{{--        <div class="container-fluid py-4">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card mb-4">--}}
{{--                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">--}}
{{--                            <h6 class="text-center">Company</h6>--}}
{{--                            <button type="button" class="btn btn-secondary float-end rounded-pill" data-bs-toggle="modal"--}}
{{--                                    id="create-modal-btn" data-bs-target="#create-modal">--}}
{{--                                <i class="fas fa-plus"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="card-body px-0 pt-0 pb-2">--}}
{{--                            <div class="table table-responsive p-3">--}}
{{--                                <table id="companiesTable" class="table table-striped datatable-exportable"--}}
{{--                                       style="width: 100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="align-middle text-center text-nowrap">S.No#</th>--}}
{{--                                        <th class="align-middle text-center text-nowrap">Logo</th>--}}
{{--                                        <th class="align-middle text-center text-nowrap">Name</th>--}}
{{--                                        <th class="align-middle text-center text-nowrap">Url</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($companies as $key => $company)--}}
{{--                                        <tr id="tr-{{$company->id}}">--}}
{{--                                            <td class="align-middle text-center text-nowrap">{{$key + 1}}--}}
{{--                                            <td class="align-middle text-center text-nowrap">--}}
{{--                                                @php--}}
{{--                                                    $logoUrl = filter_var($company->logo, FILTER_VALIDATE_URL) ? $company->logo : asset('assets/images/company-logos/'.$company->logo);--}}
{{--                                                @endphp--}}
{{--                                                <object--}}
{{--                                                    data="{{ $logoUrl }}"--}}
{{--                                                    class="avatar avatar-sm me-3"--}}
{{--                                                    title="{{ $company->name }}"--}}
{{--                                                >--}}
{{--                                                    <img--}}
{{--                                                        src="{{ $logoUrl }}"--}}
{{--                                                        alt="{{ $company->name }}"--}}
{{--                                                        class="avatar avatar-sm me-3"--}}
{{--                                                        title="{{ $company->name }}">--}}
{{--                                                </object>--}}
{{--                                            </td>--}}
{{--                                            <td class="align-middle text-center text-nowrap">{{$company->name}}--}}
{{--                                            </td>--}}
{{--                                            <td class="align-middle text-center text-nowrap">{{$company->url}}--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
    <!-- Modal -->

    @push('script')
        @include('companies.script')
        <script>
            $(document).ready(function () {
                const overlay = $('#overlay');
                const formContainer = $('#formContainer');

                // Open form
                $('.open-form-btn').click(function () {
                    formContainer.addClass('open');
                    overlay.addClass('active');
                });

                // Close form
                $('.close-btn, #overlay').click(function () {
                    formContainer.removeClass('open');
                    overlay.removeClass('active');
                });
            });


            document.addEventListener("DOMContentLoaded", () => {
                const tabs = document.querySelectorAll(".tab-item");
                const panes = document.querySelectorAll(".tab-pane");

                tabs.forEach((tab) => {
                    tab.addEventListener("click", () => {
                        // Remove active class from all tabs and panes
                        tabs.forEach((t) => t.classList.remove("active"));
                        panes.forEach((p) => p.classList.remove("active"));

                        // Add active class to the clicked tab and corresponding pane
                        tab.classList.add("active");
                        document
                            .getElementById(tab.getAttribute("data-tab"))
                            .classList.add("active");
                    });
                });
            });
        </script>
    @endpush
@endsection
