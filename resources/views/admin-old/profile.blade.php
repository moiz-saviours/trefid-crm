@extends('admin.layouts.app')
@section('title','Profile')
@section('bg',true)
@section('content')
    @push('style')
        <style>
            .image-container {
                position: relative;
                width: 200px;
                height: 200px;
            }

            .profile-page-image {
                width: 100%;
                height: 100%;
                border-radius: 10px;
            }

            .overlay-text {
                display: none;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 12px;
                background-color: rgba(0, 0, 0, 0.5);
                padding: 8px;
                border-radius: 10px;
            }

            .image-container:hover .overlay-text {
                display: block;
            }

            #imageUpload {
                display: none;
            }

            p.text-white {
                font-size: 11px;
                width: 58px;
                height: 57px;
            }
        </style>
    @endpush
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative image-container">
                        <img
                            src="{{$user->image && file_exists(public_path('assets/images/admins/'.$user->image)) ? asset('assets/images/admins/'.$user->image) : asset('assets/img/team-1.jpg')}}"
                            alt="{{$user->name}}" title="change image"
                            class="w-100 border-radius-lg shadow-sm profile-page-image profile-image">
                        <div class="overlay-text position-absolute top-50 start-50 translate-middle">
                            <p class="text-white mb-0">Click to update image</p>
                        </div>

                    </div>
                    <input type="file" id="imageUpload" class="d-none" accept="image/*">
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$user->name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$user->designation}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                    <i class="ni ni-app"></i>
                                    <span class="ms-2">App</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                    <i class="ni ni-email-83"></i>
                                    <span class="ms-2">Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "
                                   data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span class="ms-2">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                            <button class="btn btn-primary btn-sm ms-auto">Settings</button>
                        </div>
                    </div>
                    <form action="{{ route('admin.profile.update') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                               value="{{ old('name', $user->name) }}">
                                        @if($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" id="email"
                                               value="{{$user->email}}" readonly>
                                        @if($errors->has('email'))
                                            <div class="text-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Designation</label>
                                        <input class="form-control" type="text" id="designation" name="designation"
                                               value="{{ old('designation', $user->designation) }}">
                                        @if($errors->has('designation'))
                                            <div class="text-danger">{{ $errors->first('designation') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone Number</label>
                                        <input class="form-control" type="text" id="phone_number" name="phone_number"
                                               value="{{ old('phone_number', $user->phone_number) }}">
                                        @if($errors->has('phone_number'))
                                            <div class="text-danger">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="" disabled {{ !$user->gender ? 'selected' : '' }}>Select
                                                Gender
                                            </option>
                                            <option value="male" {{$user->gender == 'male' ? "selected":""}}>Male
                                            </option>
                                            <option value="female" {{$user->gender == 'female' ? "selected":""}}>Female
                                            </option>
                                        </select>
                                        @if($errors->has('gender'))
                                            <div class="text-danger">{{ $errors->first('gender') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date of Birth</label>
                                        <input class="form-control" type="date" id="dob" name="dob"
                                               value="{{ old('dob', $user->dob) }}">
                                        @if($errors->has('dob'))
                                            <div class="text-danger">{{ $errors->first('dob') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <input class="form-control" type="text" id="address" name="address"
                                               value="{{ old('address', $user->address) }}">
                                        @if($errors->has('address'))
                                            <div class="text-danger">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">City</label>
                                        <input class="form-control" type="text" id="city" name="city"
                                               value="{{ old('city', $user->city) }}">
                                        @if($errors->has('city'))
                                            <div class="text-danger">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Country</label>
                                        <input class="form-control" type="text" id="country" name="country"
                                               value="{{ old('country', $user->country) }}">
                                        @if($errors->has('country'))
                                            <div class="text-danger">{{ $errors->first('country') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Postal code</label>
                                        <input class="form-control" type="text" id="postal_code" name="postal_code"
                                               value="{{ old('postal_code', $user->postal_code) }}">
                                        @if($errors->has('postal_code'))
                                            <div class="text-danger">{{ $errors->first('postal_code') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">About me</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">About me</label>
                                        <input class="form-control" type="text" id="about" name="about"
                                               value="{{ old('about', $user->about) }}">
                                        @if($errors->has('about'))
                                            <div class="text-danger">{{ $errors->first('about') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="../assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="../assets/img/team-2.jpg"
                                         class="rounded-circle img-fluid border border-2 border-white">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                                    class="ni ni-collection"></i></a>
                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                                    class="ni ni-email-83"></i></a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">22</span>
                                        <span class="text-sm opacity-8">Friends</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder">10</span>
                                        <span class="text-sm opacity-8">Photos</span>
                                    </div>
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">89</span>
                                        <span class="text-sm opacity-8">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <h5>
                                Mark Davis<span class="font-weight-light">, 35</span>
                            </h5>
                            <div class="h6 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Bucharest, Romania
                            </div>
                            <div class="h6 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Officer
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>University of Computer Science
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                    Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                   target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                   target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('.image-container').click(function () {
                $('#imageUpload').trigger('click');
            });

            $('#imageUpload').change(function (event) {
                var file = event.target.files[0];
                if (file) {

                    var formData = new FormData();
                    formData.append('image', file);

                    AjaxPostRequestPromise(`{{route('admin.profile.image.update')}}`, formData)
                        .then(function (response) {
                            $('.profile-image').attr('src', response.imageUrl);
                        })
                        .catch(function (error) {
                        });
                    // var reader = new FileReader();
                    // reader.onload = function (e) {
                    //     $('.profile-image').attr('src', e.target.result);
                    // };
                    // reader.readAsDataURL(file);
                }
            });

        });

    </script>
@endpush
