@extends('admin.layouts.app');
@section('title','Activity Logs')
@section('datatable', true)
@section('content')
    @push('style')
        @include('admin.activity-logs.style')
    @endpush

    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <header class="custm_header">
                    <div class="new_head">
                        <h1 class="page-title mb-2">Activity Logs <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </h1>
                        <h2 id="record-count" class="h6">{{count($logs)}}records</h2>
                    </div>
                    <div class="filters">
                        <div class="actions">
                            <h1><i class="fa fa-lock" aria-hidden="true"></i> Data Quality</h1>

                            <button class="header_btn">Actions <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </button>
                            <button class="header_btn">Import</button>
                            {{--                            <button type="button" class="create-contact open-form-btn" data-bs-target="#create-modal" data-bs-toggle="modal">Add New</button>--}}
                            <button class="create-contact open-form-btn">Create New</button>

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
                            <li class="tab-item active" data-tab="home">Activity Logs
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
                                    <table id="allLogsTable" class="table table-striped datatable-exportable
                            stripe row-border order-column nowrap
                            initTable
                            ">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th class="align-middle text-center text-nowrap">SNO.</th>
                                            <th class="align-middle text-center text-nowrap">User</th>
                                            <th class="align-middle text-center text-nowrap">Logs</th>
                                            <th class="align-middle text-center text-nowrap">Timestamp</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($logs as $key => $log)
                                            <tr id="tr-{{$log->id}}">
                                                <td class="align-middle text-center text-nowrap"></td>
                                                <td class="align-middle text-center text-nowrap">{{$loop->iteration}}</td>

                                                <td class="align-middle text-center text-nowrap">{{ optional($log->actor)->name }}</td>
                                                <td class="align-middle text-center text-nowrap">{{ $log->action === 'create' ? 'created a new' :($log->action === 'updated' ? 'updated' : 'deleted') }}
                                                    {{ class_basename($log->model_type) }}: {{ $log->entity_name }}
                                                </td>
                                                <td class="align-middle text-center text-nowrap">{{ $log->created_at->timezone('Asia/Karachi')->diffForHumans() }}
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
        </div>
    </section>

    @push('script')
        @include('admin.activity-logs.script');
    @endpush
@endsection
