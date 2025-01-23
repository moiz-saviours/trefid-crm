@extends('developer.layouts.app')
@section('title', 'Developer / Edit')
@push('breadcrumb')
    <li class="breadcrumb-item text-sm" aria-current="page"><a
            href="{{route('developer.account.index')}}">Developer</a>
    </li>
    <li class="breadcrumb-item text-sm active" aria-current="page"><a
            href="{{route('developer.account.edit',[$developer->id])}}">Edit</a>
    </li>
@endpush
@section('content')
    @push('style')
        @include('developer.accounts.style')
    @endpush
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Edit Developer</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('developer.account.update', [$developer->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $developer->name) }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="example@domain.com" value="{{ old('email', $developer->email) }}"
                                       required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                       value="{{ old('designation', $developer->designation) }}"
                                       placeholder="e.g. Software Engineer">
                                @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male" {{ old('gender', $developer->gender) == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option
                                        value="female" {{ old('gender', $developer->gender) == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                       placeholder="e.g. +1234567890"
                                       value="{{ old('phone_number', $developer->phone_number) }}">
                                @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                          rows="3">{{ old('address', $developer->address) }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image (Optional)</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <input type="url" class="form-control" id="image_url" name="image_url"
                                           value="{{ old('image_url', $developer->image_url) }}"
                                           placeholder="https://example.com/image.png">
                                </div>
                                <small class="form-text text-muted">You can either upload an image or provide a valid
                                    image URL.</small>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('image_url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ old('status', $developer->status) == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ old('status', $developer->status) == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('developer.account.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
