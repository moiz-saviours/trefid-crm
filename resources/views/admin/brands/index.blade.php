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
    {{--    <div class="container-fluid py-4">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12">--}}
    {{--                <div class="card mb-4">--}}
    {{--                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">--}}
    {{--                        <h6 class="text-center">Brand Table</h6>--}}
    {{--                        <button type="button" class="btn btn-secondary float-end rounded-pill" data-bs-toggle="modal"--}}
    {{--                                id="create-modal-btn" data-bs-target="#create-modal">--}}
    {{--                            <i class="fas fa-plus"></i>--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                    <div class="card-body px-0 pt-0 pb-2">--}}
    {{--                        <div class="table table-responsive p-3">--}}
    {{--                            <table id="brandsTable" class="table table-striped datatable-exportable"--}}
    {{--                                   style="width: 100%">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Id</th>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Logo</th>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Brand Key</th>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Name</th>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Url</th>--}}
    {{--                                    <th class="align-middle text-center text-nowrap">Status</th>--}}
    {{--                                    <th class="">Action</th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                @foreach($brands as $key => $brand)--}}
    {{--                                    <tr id="tr-{{$brand->id}}">--}}
    {{--                                        <td class="align-middle text-center text-nowrap">{{$brand->id}}</td>--}}
    {{--                                        <td class="align-middle text-center text-nowrap">--}}
    {{--                                            @php--}}
    {{--                                                $logoUrl = filter_var($brand->logo, FILTER_VALIDATE_URL) ? $brand->logo : asset('assets/images/brand-logos/'.$brand->logo);--}}
    {{--                                            @endphp--}}
    {{--                                            <object--}}
    {{--                                                data="{{ $logoUrl }}"--}}
    {{--                                                class="avatar avatar-sm me-3"--}}
    {{--                                                title="{{ $brand->name }}"--}}
    {{--                                            >--}}
    {{--                                                <img--}}
    {{--                                                    src="{{ $logoUrl }}"--}}
    {{--                                                    alt="{{ $brand->name }}"--}}
    {{--                                                    class="avatar avatar-sm me-3"--}}
    {{--                                                    title="{{ $brand->name }}">--}}
    {{--                                            </object>--}}
    {{--                                        </td>--}}
    {{--                                        <td class="align-middle text-center text-nowrap">{{$brand->brand_key}}</td>--}}
    {{--                                        <td class="align-middle text-center text-nowrap">{{$brand->name}}--}}
    {{--                                        </td>--}}
    {{--                                        <td class="align-middle text-center text-nowrap">{{$brand->url}}--}}
    {{--                                        </td>--}}
    {{--                                        <td class="align-middle text-center text-nowrap">--}}
    {{--                                            <input type="checkbox" class="status-toggle change-status" data-id="{{ $brand->id }}"--}}
    {{--                                                   {{ $brand->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">--}}
    {{--                                        </td>--}}
    {{--                                        <td class="align-middle text-center table-actions">--}}
    {{--                                            <a href="javascript:void(0)" data-id="{{ $brand->id }}"--}}
    {{--                                               class="text-secondary editBtn" title="Edit Brand">--}}
    {{--                                                <i class="fas fa-edit"></i>--}}
    {{--                                            </a>--}}
    {{--                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"--}}
    {{--                                               data-id="{{ $brand->id }}" title="Delete Brand">--}}
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
                        <h1 class="page-title mb-2">Brands <i class="fa fa-caret-down" aria-hidden="true"></i></h1>
                        <h2 id="record-count" class="h6">{{count($brands)}} records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                            <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn">Import</button>
                            {{--                            <button type="button" class="create-contact open-form-btn" data-bs-target="#create-modal" data-bs-toggle="modal">Add New</button>--}}
                            <button class="create-contact open-form-btn">Create Brand</button>

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
                            <li class="tab-item active" data-tab="home">Brands
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
                                    <table id="allBrandsTable" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap
                            initTable
                            ">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th class="align-middle text-center text-nowrap">SNO.</th>
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
                                                <td class="align-middle text-center text-nowrap"></td>
                                                <td class="align-middle text-center text-nowrap">{{$loop->iteration}}</td>
                                                <td class="align-middle text-center text-nowrap">
                                                    @php
                                                        $logoUrl = filter_var($brand->logo, FILTER_VALIDATE_URL) ? $brand->logo : asset('assets/images/brand-logos/'.$brand->logo);
                                                    @endphp
                                                    <object
                                                        data="{{ $logoUrl }}"
                                                        class="avatar avatar-sm me-3"
                                                        style="width: 100px; height: 50px;"
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
                                                    <input type="checkbox" class="status-toggle change-status"
                                                           data-id="{{ $brand->id }}"
                                                           {{ $brand->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                                </td>
                                                <td class="align-middle text-center table-actions">
                                                    <button type="button" class="btn btn-sm btn-primary editBtn"
                                                            data-id="{{ $brand->id }}" title="Edit"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                                            data-id="{{ $brand->id }}" title="Delete"><i
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
                    @include('admin.brands.custom-form')
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    @include('admin.brands.create-modal')
    @include('admin.brands.edit-modal')

    @push('script')
        @include('admin.brands.script')
        <script>

            $(document).ready(function () {
                const formContainer = $('#formContainer');
                $('.open-form-btn , .editBtn').click(function () {
                    $(this).hasClass('void') ? $(this).attr('title', "You don't have access to create a company.").tooltip({placement: 'bottom'}).tooltip('show') : (formContainer.addClass('open'));
                });
                $(document).click(function (event) {
                    if (
                        (
                            !$(event.target).closest('#formContainer').length
                            && !$(event.target).is('#formContainer')
                            && !$(event.target).closest('.open-form-btn').length
                            && !$(event.target).is('.editBtn')
                        )
                        || $(event.target).is('#formContainer .close-btn')
                        )   {
                                formContainer.removeClass('open')
                                $('form')[0].reset();
                            }
                });
                $(".tab-item").on("click", function () {
                    $(".tab-item").removeClass("active");
                    $(".tab-pane").removeClass("active");

                    $(this).addClass("active");

                    const targetPane = $(this).data("tab");
                    $("#" + targetPane).addClass("active");
                });
            });
        </script>
    @endpush
@endsection
