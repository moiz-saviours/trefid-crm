@extends('developer.layouts.app')
@section('title', 'Lead / Edit')
@push('breadcrumb')
    <li class="breadcrumb-item text-sm" aria-current="page">
        <a href="{{ route('developer.lead.index') }}">Leads</a>
    </li>
    <li class="breadcrumb-item text-sm active" aria-current="page">
        <a href="{{ route('developer.lead.edit', $lead->id) }}">Edit</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.leads.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Edit Lead</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('developer.lead.update', $lead->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Brand Dropdown -->
                                <div class="col-md-4 mb-3">
                                    <label for="brand_key" class="form-label">Brand</label>
                                    <select class="form-control searchable" id="brand_key" name="brand_key"
                                            title="Please select a brand" required>
                                        <option value="" disabled>Please select brand</option>
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{ $brand->brand_key }}" {{ $lead->brand_key == $brand->brand_key ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_key')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Team Dropdown -->
                                <div class="col-md-4 mb-3">
                                    <label for="team_key" class="form-label">Team</label>
                                    <select class="form-control searchable" id="team_key" name="team_key"
                                            title="Please select team">
                                        <option value="" disabled>Please select team</option>
                                        @foreach($teams as $team)
                                            <option
                                                value="{{ $team->team_key }}" {{ $lead->team_key == $team->team_key ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('team_key')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- CustomerContact Type Selection (New or Existing) -->
                                <div class="col-md-4 mb-3">
                                    <label for="type" class="form-label">Client Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="0" {{ $lead->type == 0 ? 'selected' : '' }}>New</option>
                                        @if($clients->count() > 0)
                                            <option value="1" {{ $lead->type == 1 ? 'selected' : '' }}>Existing</option>
                                        @endif
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fresh CustomerContact Fields -->
                                <div id="fresh-client-fields" class="col-md-12 mb-3 {{ $lead->type != 0 ? 'd-none' : '' }}">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="client_name" class="form-label">Client Name</label>
                                            <input type="text" class="form-control" id="client_name" name="client_name"
                                                   value="{{ $lead->client_name }}">
                                            @error('client_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="client_email" class="form-label">Client Email</label>
                                            <input type="email" class="form-control" id="client_email"
                                                   name="client_email" value="{{ $lead->client_email }}">
                                            @error('client_email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="client_phone" class="form-label">Client Phone</label>
                                            <input type="text" class="form-control" id="client_phone"
                                                   name="client_phone" value="{{ $lead->client_phone }}">
                                            @error('client_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Upsale CustomerContact Fields -->
                                <div id="upsale-client-fields" class="col-md-4 mb-3 {{ $lead->type != 1 ? 'd-none' : '' }}">
                                    <label for="client_key" class="form-label">Select Existing Client</label>
                                    <select class="form-control searchable" id="client_key" name="client_key">
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option
                                                value="{{ $client->client_key }}" {{ $lead->client_key == $client->client_key ? 'selected' : '' }}>
                                                {{ $client->name }} ({{ $client->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_key')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Lead Status Dropdown -->
                                <div class="col-md-4 mb-3">
                                    <label for="lead_status_id" class="form-label">Lead Type</label>
                                    <select class="form-control searchable" id="lead_status_id" name="lead_status_id"
                                            required>
                                        <option value="" disabled>Please select lead status</option>
                                        @foreach($leadStatuses as $lead_status)
                                            <option
                                                value="{{ $lead_status->id }}" {{ $lead->lead_status_id == $lead_status->id ? 'selected' : '' }}>
                                                {{ $lead_status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lead_status_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Note -->
                                <div class="col-md-12 mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea class="form-control" rows="6" id="note" name="note">{{ $lead->note }}</textarea>
                                        @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('developer.lead.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @include('developer.leads.script')
        <script>
            $(document).ready(function () {
                $('#type').on('change', function () {
                    const type = $(this).val();
                    $('#fresh-client-fields').toggleClass('d-none', type != 0);
                    $('#client_name, #client_email, #client_phone').prop('required', type == 0);
                    $('#upsale-client-fields').toggleClass('d-none', type != 1);
                    $('#client_key').prop('required', type == 1);
                }).trigger('change');
            });
        </script>
    @endpush
@endsection
