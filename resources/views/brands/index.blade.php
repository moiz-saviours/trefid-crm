@extends('layouts.app')
@section('title','Companies')
@section('datatable', true)
@section('content')
    @push('style')
        @include('brands.style')
    @endpush
    <section id="content" class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6 class="text-center">Company</h6>
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
                                        <th class="align-middle text-center text-nowrap">S.No#</th>
                                        <th class="align-middle text-center text-nowrap">Logo</th>
                                        <th class="align-middle text-center text-nowrap">Name</th>
                                        <th class="align-middle text-center text-nowrap">Url</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $key => $brand)
                                        <tr id="tr-{{$brand->id}}">
                                            <td class="align-middle text-center text-nowrap">{{$key + 1}}
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
                                            <td class="align-middle text-center text-nowrap">{{$brand->name}}
                                            </td>
                                            <td class="align-middle text-center text-nowrap">{{$brand->url}}
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
    </section>
{{--    <section id="content" class="content">--}}

{{--        <div class="container">--}}
{{--            <!-- Header Bar -->--}}
{{--            <div class="header-bar">--}}
{{--                <h1>Contacts</h1>--}}
{{--                <div class="actions">--}}
{{--                    <button>Actions</button>--}}
{{--                    <button>Import</button>--}}
{{--                    <button>Create Contact</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Filters -->--}}
{{--            <div class="filters">--}}
{{--                <div class="filter-buttons">--}}
{{--                    <button>(1) Contact Owner</button>--}}
{{--                    <button>Create Date</button>--}}
{{--                    <button>Last Activity Date</button>--}}
{{--                    <button>More</button>--}}
{{--                </div>--}}
{{--                <div class="clear-filters">--}}
{{--                    <button>Clear Quick Filters</button>--}}
{{--                    <button>Advanced Filters</button>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Table -->--}}
{{--            <div class="table-container">--}}
{{--                <div class="search-box">--}}
{{--                    <input type="text" placeholder="Search name, phone, email">--}}
{{--                </div>--}}
{{--                <table>--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Name</th>--}}
{{--                        <th>Email</th>--}}
{{--                        <th>Phone Number</th>--}}
{{--                        <th>Lead Status</th>--}}
{{--                        <th>Create Date</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>Payload</td>--}}
{{--                        <td>payload@gmail.com</td>--}}
{{--                        <td>0987654321</td>--}}
{{--                        <td>Unqualified</td>--}}
{{--                        <td>Dec 3, 2024</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}

{{--                <!-- Pagination -->--}}
{{--                <div class="pagination">--}}
{{--                    <span class="records">1 record</span>--}}
{{--                    <div class="page-controls">--}}
{{--                        <button disabled>Prev</button>--}}
{{--                        <button class="active">1</button>--}}
{{--                        <button>Next</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- Modal -->
    {{--    @include('brands.create-modal')--}}
    {{--    @include('brands.edit-modal')--}}

    @push('script')
        @include('brands.script')
    @endpush
@endsection
