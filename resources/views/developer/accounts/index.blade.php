@extends('developer.layouts.app')
@section('title','Developers')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('developer.account.index')}}">Developer</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.accounts.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Developer Table</h3>
                        <a href="{{ route('developer.account.create') }}"
                           class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="developersTable" class="table table-striped" style="width: 100%">
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
                                @foreach($developers as $developer)
                                    <tr id="tr-{{$developer->id}}">
                                        <td class="align-middle text-center text-nowrap">{{ $developer->id }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            @if($developer->image)
                                                @php
                                                    $imageUrl = filter_var($developer->image, FILTER_VALIDATE_URL) ? $developer->image : asset('assets/images/developers/' . $developer->image);
                                                @endphp
                                                <object
                                                    data="{{ $imageUrl }}"
                                                    class="avatar avatar-sm me-3"
                                                    title="{{ $developer->name }}"
                                                >
                                                    <img
                                                        src="{{ $imageUrl }}"
                                                        alt="{{ $developer->name }}"
                                                        class="avatar avatar-sm me-3"
                                                        title="{{ $developer->name }}">
                                                </object>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ $developer->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $developer->email }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $developer->designation }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle change-status"
                                                   data-id="{{ $developer->id }}"
                                                   {{ $developer->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('developer.account.edit', [$developer->id]) }}"
                                               class="text-secondary" title="Edit Record">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $developer->id }}" title="Delete Record">
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
        @include('developer.accounts.script')
    @endpush
@endsection
