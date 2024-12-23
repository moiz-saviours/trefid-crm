
<div class="custom-form">
    <form id="manage-form" method="POST" enctype="multipart/form-data">
        <div class="form-container" id="formContainer">
            <!-- Form Header -->
            <div class="form-header fh-1">
                <span id="custom-form-heading">Manage Team</span>
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Team Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Team Lead</label>
                    <select class="form-control select2" id="lead_id" name="lead_id" >
                        <option value="" selected>Select Team Lead</option>
                        @foreach($users as $user)
                            <option
                                value="{{ $user->id }}" {{ old('lead_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                        @error('lead')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="designation" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">

                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="address" class="form-label">Team Members</label>
                    @foreach($users as $user)
                        <div class="col-md-2">
                            <div class="image-checkbox-container">
                                <input type="checkbox" name="employees[]" value="{{ $user->id }}" id="user-{{ $user->id }}"
                                       {{ in_array($user->id, old('employees', [])) ? 'checked' : '' }}
                                       class="select-user-checkbox">
                                <img
                                    src="{{ $user->image && file_exists(public_path('assets/images/employees/'.$user->image)) ? asset('assets/images/employees/'.$user->image) : asset('assets/img/team-1.jpg') }}"
                                    alt="{{ $user->name }}" title="{{ $user->email }}"
                                    class="rounded-circle user-image" width="30" height="30">
                                <div class="checkmark-overlay">✔</div>
                            </div>
                            <div>
                                <strong>{{ $user->name }}</strong>
                            </div>
                        </div>
                    @endforeach
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="form-label d-block">Profile Image (Optional)</label>

                    <div class="d-flex align-items-start">
                        <!-- Image Upload Section (Left) -->
                        <div class="me-3" id="image-div" style="display: none">
                            <label for="image">
                                <img id="image-display" src="" alt="Preview"
                                     class="img-thumbnail"
                                     style="cursor: pointer; max-width: 100px;"
                                     title="Click to choose a new file">
                            </label>
                        </div>

                        <!-- Input Fields (Right) -->
                        <div class="flex-grow-1">
                            <div class="">
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" aria-describedby="imageHelp">
                            </div>
                            <div class="input-group">
                                <input type="url" class="form-control" id="image_url" name="image_url"
                                       placeholder="https://example.com/image.png" aria-describedby="imageHelp">
                            </div>
                            <small id="imageHelp" class="form-text text-muted">
                                You can either upload an image or provide a valid image URL.
                            </small>
                            <!-- Validation Error Messages -->
                            @error('image')
                            <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                            @error('image_url')
                            <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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


