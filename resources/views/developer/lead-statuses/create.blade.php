{{--@extends('developer.layouts.app')--}}
{{--@section('title', 'Lead Status / Create')--}}
{{--@push('breadcrumb')--}}
{{--    <li class="breadcrumb-item text-sm text-white" aria-current="page">--}}
{{--        <a href="{{ route('developer.lead-status.index') }}">Lead Status</a>--}}
{{--    </li>--}}
{{--    <li class="breadcrumb-item text-sm text-white active" aria-current="page">--}}
{{--        <a href="{{ route('developer.lead-status.create') }}">Create</a>--}}
{{--    </li>--}}
{{--@endpush--}}

{{--@section('content')--}}
{{--    <div class="container-fluid py-4">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card mb-4">--}}
{{--                    <div class="card-header pb-0">--}}
{{--                        <h5>Create Lead Status</h5>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{ route('developer.lead-status.store') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="row">--}}
{{--                                <!-- Name -->--}}
{{--                                <div class="col-md-6 mb-3">--}}
{{--                                    <label for="name" class="form-label">Name</label>--}}
{{--                                    <input type="text" class="form-control" id="name" name="name"--}}
{{--                                           value="{{ old('name') }}" required>--}}
{{--                                    @error('name')--}}
{{--                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <!-- Color -->--}}
{{--                                <div class="col-md-6 mb-3">--}}
{{--                                    <label for="color" class="form-label">Color</label>--}}
{{--                                    <input type="text" class="form-control" id="color" name="color"--}}
{{--                                           value="{{ old('color') }}" placeholder="#FFFFFF" required>--}}
{{--                                    @error('color')--}}
{{--                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

{{--                                <!-- Description -->--}}
{{--                                <div class="col-md-12 mb-3">--}}
{{--                                    <label for="description" class="form-label">Description</label>--}}
{{--                                    <textarea class="form-control" id="description" name="description"--}}
{{--                                              rows="3">{{ old('description') }}</textarea>--}}
{{--                                    @error('description')--}}
{{--                                    <span class="text-danger">{{ $message }}</span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Submit Button -->--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <button type="submit" class="btn btn-primary">Save Lead Status</button>--}}
{{--                                <a href="{{ route('developer.lead-status.index') }}" class="btn btn-secondary">Cancel</a>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@push('script')--}}
{{--    <script>--}}
{{--        // Optional: Add a JavaScript color picker--}}
{{--        document.getElementById('color').addEventListener('input', function (event) {--}}
{{--            const inputValue = event.target.value;--}}
{{--            if (!/^#[0-9A-Fa-f]{6,8}$/.test(inputValue)) {--}}
{{--                event.target.setCustomValidity('Please enter a valid hex color code, e.g., #FFFFFF.');--}}
{{--            } else {--}}
{{--                event.target.setCustomValidity('');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
