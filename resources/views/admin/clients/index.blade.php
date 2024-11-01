@extends('admin.layouts.app')
@section('title', 'Clients')
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
                        <h3 class="text-center">Clients Table</h3>
                        <a href="{{ route('admin.client.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-0">
                            <table id="clientsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">ID</th>
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
                                        <td class="align-middle text-center text-nowrap">{{ $client->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->email }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->phone }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->address }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->city }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $client->state }}</td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-{{ $client->status == 1 ? 'success' : 'primary' }}">
                                                {{ $client->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.client.edit', $client->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit client">
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
                // $('#clientsTable').DataTable(); // Initialize DataTable
            });
        </script>
    @endpush
@endsection
