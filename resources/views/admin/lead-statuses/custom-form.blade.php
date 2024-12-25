<div class="custom-form">
    <form id="manage-form" method="POST" enctype="multipart/form-data">
        <div class="form-container" id="formContainer">
            <!-- Form Header -->
            <div class="form-header fh-1">
                Manage Lead Status
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="color" class="form-control" id="color" name="color" value="#FFFFFF" required>
                    @error('color')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
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
