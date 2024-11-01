@extends('admin.layouts.app')
@section('title', 'Leads')
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h3 class="text-center">Leads Table</h3>
                        <a href="{{ route('admin.lead.create') }}" class="btn btn-primary float-end">
                            <i class="fas fa-plus"></i> Create Lead
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="leadsTable" class="table table-striped" style="width: 100%">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Name</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Phone</th>
                                    <th class="align-middle text-center">Status</th>
                                    <th class="align-middle text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leads as $lead)
                                    <tr>
                                        <td class="align-middle text-center">{{ $lead->id }}</td>
                                        <td class="align-middle text-center">{{ $lead->name }}</td>
                                        <td class="align-middle text-center">{{ $lead->email }}</td>
                                        <td class="align-middle text-center">{{ $lead->phone }}</td>
                                        <td class="align-middle text-center">
                                            <span class="badge bg-gradient-{{ $lead->status == 1 ? 'success' : 'primary' }}">
                                                {{ $lead->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.lead.edit', $lead->id) }}" class="text-secondary font-weight-bold text-xs">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.lead.destroy', $lead->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs" onclick="return confirm('Are you sure?');">Delete</button>
                                            </form>
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

@endsection
