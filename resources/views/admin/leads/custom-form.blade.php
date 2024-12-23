<div class="custom-form">
    <form id="manage-form" action="{{ route('admin.lead.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-container" id="formContainer">
            <!-- Form Header -->
            <div class="form-header fh-1">
                <span id="custom-form-heading">Manage Lead</span>
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">
                <div class="form-group mb-3">
                    <label for="brand_key" class="form-label">Brand</label>
                    <select class="form-control searchable" id="brand_key" name="brand_key"
                            title="Please select a brand" required>
                        <option value="" selected>Please select brand</option>
                        @foreach($brands as $brand)
                            <option
                                value="{{ $brand->brand_key }}" {{ old('brand_key') == $brand->brand_key ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_key')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="team_key" class="form-label">Team</label>
                    <select class="form-control searchable" id="team_key" name="team_key"
                            title="Please select a Team" required>
                        <option value="" selected>Please select Team</option>
                        @foreach($teams as $team)
                            <option
                                value="{{ $team->team_key }}" {{ old('team_key') == $team->team_key ? 'selected' : '' }}>
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_key')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Client Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>New</option>
                        @if($clients->count() > 0)
                            <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Existing</option>
                        @endif
                    </select>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name"
                           value="{{ old('client_name') }}">
                    @error('client_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="client_email" class="form-label">Client Email</label>
                    <input type="email" class="form-control" id="client_email"
                           name="client_email" value="{{ old('client_email') }}">
                    @error('client_email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="client_phone" class="form-label">Client Phone</label>
                    <input type="text" class="form-control" id="client_phone"
                           name="client_phone" value="{{ old('client_phone') }}">
                    @error('client_phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="lead_status_id" class="form-label">Lead Type</label>
                    <select class="form-control searchable" id="lead_status_id" name="lead_status_id"
                            required>
                        <option value="" selected>Please select lead status</option>
                        @foreach($leadStatuses as $lead_status)
                            <option
                                value="{{ $lead_status->id }}" {{ old('lead_status_id') == $lead_status->id ? 'selected' : '' }}>
                                {{ $lead_status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('lead_status_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-control" rows="6" id="note" name="note">{{ old('note') }}</textarea>
                    @error('note')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-button">
                <button type="submit" class="btn-primary save-btn">Save</button>
                <button type="button" class="btn-secondary close-btn">Cancel</button>
            </div>
        </div>
    </form>
</div>
