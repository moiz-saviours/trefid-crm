@extends('user.layouts.app')
@section('title','Brands')
@section('datatable', true)
@section('content')
    @push('style')
        @include('user.brands.style')

    @endpush

    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <header class="custm_header">
                    <div class="new_head">
                        <h1 class="page-title mb-2">Brands <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </h1>
                        <h2 id="record-count" class="h6">{{ count($teams) }} records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                            <button class="header_btn" disabled>Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn" disabled>Import</button>
                            <button class="create-contact open-form-btn void">Create New</button>
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
                            @foreach($teams as $team)
                                <li class="tab-item {{$loop->first ? "active":""}}"
                                    data-tab="tab-pane-{{$team->team_key}}">{{$team->name}}<i
                                        class="fa fa-times close-icon"
                                        aria-hidden="true"></i></li>
                            @endforeach
                                <li class="tab-item"
                                    data-tab="tab-pane-"><i
                                        class="fa fa-times close-icon"
                                        aria-hidden="true"></i></li>
                        </ul>
                        {{--                        <div class="tab-buttons" >--}}
                        {{--                            <button class="btn btn-primary"><i class="fa fa-add"></i> Views (2/5)</button>--}}
                        {{--                            <button class="btn btn-secondary">All Views</button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="tab-content">
                        @foreach($teams as $index => $team)
                            <div class="tab-pane {{$loop->first ? "active":""}}" id="tab-pane-{{$team->team_key}}">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="container">
                                            <div class="row fltr-sec">
                                                <div class="col-md-8">
                                                    {{--                                                <ul class="custm-filtr">--}}
                                                    {{--                                                    <div class="table-li">--}}
                                                    {{--                                                        <li class="">CustomerCompany Owner <i class="fa fa-caret-down"--}}
                                                    {{--                                                                                      aria-hidden="true"></i></li>--}}
                                                    {{--                                                        <li class="">Create date <i class="fa fa-caret-down"--}}
                                                    {{--                                                                                    aria-hidden="true"></i></li>--}}
                                                    {{--                                                        <li class="">Last activity date <i class="fa fa-caret-down"--}}
                                                    {{--                                                                                           aria-hidden="true"></i>--}}
                                                    {{--                                                        </li>--}}
                                                    {{--                                                        <li class="">Lead status <i class="fa fa-caret-down"--}}
                                                    {{--                                                                                    aria-hidden="true"></i></li>--}}
                                                    {{--                                                        <li class=""><i class="fa fa-bars" aria-hidden="true"></i> All--}}
                                                    {{--                                                            filters--}}
                                                    {{--                                                        </li>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                </ul>--}}
                                                </div>
                                                <div class="col-md-4 right-icon" id="right-icon-{{ $index }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="{{$team->team_key}}-Table" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap initTable">
                                            <thead>
                                            <tr>
                                                <th class="align-middle text-center text-nowrap"><input type="checkbox"></th>
                                                <th class="align-middle text-center text-nowrap">ID</th>
                                                <th class="align-middle text-center text-nowrap">Logo</th>
                                                <th class="align-middle text-center text-nowrap">Name</th>
                                                <th class="align-middle text-center text-nowrap">Url</th>
                                                <th class="align-middle text-center text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($team->brands as $brand)
                                                <tr>
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
                                                            title="{{ $brand->name }}">

                                                            <img
                                                                src="{{ $logoUrl }}"
                                                                alt="{{ $brand->name }}"
                                                                class="avatar avatar-sm me-3"
                                                                title="{{ $brand->name }}">
                                                        </object>
                                                    </td>
                                                    <td class="align-middle text-center text-nowrap">{{$brand->name}} <br> {{$brand->brand_key}} </td>
                                                    <td class="align-middle text-center text-nowrap">{{$brand->url}}</td>
                                                    <td class="align-middle text-center table-actions">
                                                        <button type="button" class="btn btn-sm btn-primary editBtn"
                                                                data-id="{{ $brand->id }}" title="Edit"><i
                                                                class="fas fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->



    @push('script')
        @include('user.brands.script')
        <script>

            $(document).ready(function () {
                const formContainer = $('#formContainer');
                $('.open-form-btn').click(function () {
                    $(this).hasClass('void') ? $(this).attr('title', "You don't have access to create a company.").tooltip({placement: 'bottom'}).tooltip('show') : (formContainer.addClass('open'));
                });
                $(document).click(function (event) {
                    if (!$(event.target).closest('#formContainer').length && !$(event.target).is('#formContainer') && !$(event.target).closest('.open-form-btn').length) {
                        formContainer.removeClass('open')
                    }
                });
                $(".tab-item").on("click", function () {
                    // Remove 'active' class from all tabs and panes
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
