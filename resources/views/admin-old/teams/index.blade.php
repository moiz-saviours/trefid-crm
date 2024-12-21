@extends('admin.layouts.app')
@section('title','Teams')
@section('datatable', true)
@push('breadcrumb')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a href="{{route('admin.team.index')}}">Team</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('admin.teams.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Teams Table</h3>
                        <a href="{{ route('admin.team.create') }}" class="btn btn-secondary float-end rounded-pill"><i
                                class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-3">
                            <table id="teamsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Team Key</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Description</th>
                                    <th class="align-middle text-center text-nowrap">Assigned Brands</th>
                                    <th class="align-middle text-center text-nowrap">Lead</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $team)
                                    <tr id="tr-{{$team->id}}">
                                        <td class="align-middle text-center text-nowrap">{{ $team->id }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->team_key }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->description }}</td>
                                        <td class="align-middle text-center text-nowrap" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;" title="{{ implode(', ', $team->brands->pluck('name')->toArray()) }}">
                                            {{ implode(', ', $team->brands->pluck('name')->toArray()) }}
                                        </td>


                                        <td class="align-middle text-center text-nowrap">{{ optional($team->lead)->name }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <input type="checkbox" class="status-toggle" data-id="{{ $team->id }}"
                                                   {{ $team->status == 1 ? 'checked' : '' }} data-bs-toggle="toggle">
                                        </td>
                                        <td class="align-middle text-center table-actions">
                                            <a href="{{ route('admin.team.edit', [$team->id]) }}"
                                               class="text-secondary" title="Edit Team">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-secondary deleteBtn"
                                               data-id="{{ $team->id }}" title="Delete Team">
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
        @include('admin.teams.script')
    @endpush
@endsection
