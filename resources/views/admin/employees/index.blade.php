@extends('admin.layouts.app')
@section('title', 'Employees')
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
                        <h3 class="text-center">Employee Table</h3>
                        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table table-responsive p-0">
                            <table id="employeesTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center text-nowrap">Id</th>
                                    <th class="align-middle text-center text-nowrap">Image</th>
                                    <th class="align-middle text-center text-nowrap">Name</th>
                                    <th class="align-middle text-center text-nowrap">Designation</th>
                                    <th class="align-middle text-center text-nowrap">Status</th>
                                    <th class=""></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="align-middle text-center text-nowrap">{{ $user->id }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                            <img src="{{ filter_var($user->image, FILTER_VALIDATE_URL) ? $user->image : asset('assets/images/employees/' . $user->image) }}"
                                                 class="avatar avatar-sm me-3"
                                                 alt="{{ $user->name }}" title="{{ $user->name }}">
                                        </td>
                                        <td class="align-middle text-center text-nowrap">{{ $user->name }}</td>
                                        <td class="align-middle text-center text-nowrap">{{ $user->designation }}</td>
                                        <td class="align-middle text-center text-nowrap">
                                                <span class="badge badge-sm bg-gradient-{{ $user->status == 1 ? 'success' : 'primary' }}">
                                                    {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.employee.edit', $user->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
                // $('#employeesTable').DataTable(); // Initialize DataTable
            });
        </script>
    @endpush
@endsection
