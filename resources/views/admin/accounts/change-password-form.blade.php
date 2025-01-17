@push('style')
    <style>
        .generatePassword {
            padding: 8px;
            cursor: pointer;
            font-size: 18px;
            background-color: var(--bs-primary);
            border-radius: 5px;
            height: 35px;
            width: 35px;
            color: var(--bs-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 15px;

        }
        .generatePassword:hover {
            color: var(--bs-primary);
            background-color: var(--bs-light);
            border: 1px solid var(--bs-primary);
        }
    </style>
@endpush

<div class="custom-form">
    <form id="manage-form-2" method="POST" enctype="multipart/form-data" class="manage-form">
        <div class="form-container" id="formContainerChangePassword">
            <!-- Form Header -->
            <div class="form-header fh-1">
                <span id="custom-form-heading">Manage Account</span>
                <button type="button" class="close-btn">×</button>
            </div>
            <!-- Form Body -->
            <div class="form-body">

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="d-fldex align-items-center">
                        <input type="text" id="password" name="password" class="form-control" placeholder="Generated Password">
                        <i id="generatePassword" class="generatePassword  ms-2" title="Change Password">Generate Password</i>
                    </div>
                    @error('password')
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

@push('script')
    <script>
        $(document).ready(function () {
            $('.generatePassword').click(function () {
                const randomPassword = generateRandomPassword(12);
                $('#password').val(randomPassword);
            });
        });
    </script>
@endpush
