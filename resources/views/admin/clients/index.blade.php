@extends('admin.layouts.app')
@section('title','Clients')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a
            href="{{route('admin.client.index')}}">Client</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.clients.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Clients Table</h3>
                        <a href="{{ route('admin.client.create') }}"
                           class="btn btn-secondary float-end rounded-pill"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="clientsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">ID</th>
                                    <th class="align-middle text-center text-nowrap">Brand</th>
                                    <th class="align-middle text-center text-nowrap">Team</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Email</th>
                                    <th class="align-middle text-center text-nowrap">Phone</th>
                                    <th class="align-middle text-center text-nowrap">Address</th>
                                    <th class="align-middle text-center text-nowrap">City</th>
                                    <th class="align-middle text-center text-nowrap">State</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap">{{ $client->id }}</td>

                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($client->brand))
                                                <a href="{{route('admin.brand.edit',[$client->brand->id])}}">{{ $client->brand->name }}</a>
                                                <br> {{ $client->brand->brand_key }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if(isset($client->team))
                                                <a href="{{route('admin.team.edit',[$client->team->id])}}">{{ $client->team->name }}</a>
                                                <br> {{ $client->team->team_key }}
                                            @else
                                                ---
                                            @endif
                                        </td><td class="align-middle text-center text-nowrap">{{ $client->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->email }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->phone }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->address }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->city }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->state }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status" data-id="{{ $client->id }}"
                                                   {{ $client->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('admin.client.edit', [$client->id]) }}"
                                               class="text-secondary" title="Edit Client">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $client->id }}" title="Delete Client">
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
        @include('admin.clients.script')
    @endpush
@endsection

