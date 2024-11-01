@extends('admin.layouts.app')
@section('title', 'Teams')
@section('content')
    @push('css')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    @endpush

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Teams Table</h3>
                        <a href="{{ route('admin.team.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-0">
                            <table id="teamsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Team Key</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Description</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap">{{ $team->id }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->team_key }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $team->description }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <span class="badge badge-sm bg-gradient-{{ $team->status == 1 ? 'success' : 'primary' }}">
                                                {{ $team->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.team.edit', $team->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit team">
                                                Edit
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
        <!-- DataTables JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
        <script>
            $(document).ready(function () {
                // $('#teamsTable').DataTable(); // Initialize DataTable
            });
        </script>
    @endpush
@endsection
