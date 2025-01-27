<div class="custom-form">
    <form id="manage-form" class="manage-form" method="POST" enctype="multipart/form-data" class="m-0">
        <div class="form-container" id="formContainer">
            <!-- Form Header -->
            <div class="form-header fh-1">
                <span id="custom-form-heading">Manage Client Account</span>
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">
                <div class="form-group mb-3">
                    <label for="brand_key" class="form-label">Brand</label>
                    <select class="form-control" id="brand_key" name="brand_key">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option
                                value="{{ $brand->brand_key }}" {{ old('brand_key') == $brand->brand_key ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_key')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name') }}"
                           required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="descriptor" class="form-label">Descriptor</label>
                    <input type="text" class="form-control" id="descriptor" name="descriptor"
                           value="{{ old('descriptor') }}"
                           required>
                    @error('descriptor')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="vendor_name" class="form-label">Vendor Name</label>
                    <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                           value="{{ old('vendor_name') }}" required>
                    @error('vendor_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email') }}" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="login_id" class="form-label">Login ID</label>
                    <input type="text" class="form-control" id="login_id" name="login_id"
                           value="{{ old('login_id') }}" required>
                    @error('login_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="transaction_key" class="form-label">Transaction Key</label>
                    <input type="text" class="form-control" id="transaction_key"
                           name="transaction_key"
                           value="{{ old('transaction_key') }}" required>
                    @error('transaction_key')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="limit" class="form-label">Limit</label>
                    <input type="number" class="form-control" id="limit" name="limit" step="1"
                           min="1"
                           value="{{ old('limit') }}" required>
                    @error('limit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="environment" class="form-label">Environment</label>
                    <select class="form-control" id="environment" name="environment" required>
                        <option
                            value="sandbox" {{ old('environment') == 'sandbox' ? 'selected' : '' }}>
                            Sandbox
                        </option>
                        <option
                            value="production" {{ old('environment') == 'production' ? 'selected' : '' }}>
                            Production
                        </option>
                    </select>
                    @error('environment')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option
                            value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option
                            value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>
                            Suspended
                        </option>
                    </select>
                    @error('status')
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
