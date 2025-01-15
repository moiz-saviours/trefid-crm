<div class="custom-form">
    <form id="manage-form" method="POST" enctype="multipart/form-data">
        <div class="form-container" id="formContainer">
            <!-- Form Header -->
            <div class="form-header fh-1">
                Manage Brand
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">
                <div class="">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="url" class="form-label">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter url">
                    @error('url')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <label for="logo" class="form-label">Logo (Optional)</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        <input type="url" class="form-control" id="logo_url" name="logo_url"
                               placeholder="https://example.com/logo.png">
                    </div>
                    <small class="form-text text-muted">You can either upload an image or provide a valid image
                        URL.</small>
                    @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('logo_url')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-button">
                <button type="submit" class="btn-primary save-btn">Save</button>
                <button type="button" class="btn-secondary close-btn">Cancel</button>
            </div>
        </div>
    </form>
</div>
