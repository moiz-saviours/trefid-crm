<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-form" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                               value="{{ old('name') }}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_url" class="form-label">Brand URL</label>
                        <input type="url" class="form-control" id="edit_url" name="url"
                               value="{{ old('url') }}" placeholder="https://example.com">
                        @error('url')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_logo" class="form-label">Brand Logo</label>
                        <div class="form-group">
{{--                            @if (!empty($brand->logo))--}}
{{--                                @if( @getimagesize($brand->logo))--}}
{{--                                    <img id="brand-logo" src="{{ $brand->logo }}" alt="Brand Logo">--}}
{{--                                @else--}}
{{--                                    <img id="brand-logo" src="{{ asset('assets/images/brand-logos/'.$brand->logo) }}"--}}
{{--                                         alt="Brand Logo">--}}
{{--                                @endif--}}
{{--                            @endif--}}
                            <img id="brand-logo" src="" alt="" class="hide">
                            <input type="file" class="form-control" id="edit_logo" name="logo" accept="image/*">
                        </div>

                        <input type="text" class="form-control" id="edit_logo_url" name="logo_url"
                               value="{{ old('logo_url') }}"
                               placeholder="https://example.com/logo.png">
                        <small class="form-text text-muted">You can either upload an image or provide a valid
                            image URL.</small>
                        @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('logo_url')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email"
                               value="{{ old('email') }}" placeholder="example@domain.com">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description"
                                  rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="update-form" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


