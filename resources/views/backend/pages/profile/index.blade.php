@extends('backend.layouts.app')
@section('title','Profile')
@push('css')
<style>
    .btn_upload {
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        position: relative;
        color: #fff;
        background-color: #2a72d4;
        border: 1px solid #166b8a;
        padding: 5px 10px;
    }
    .btn_upload input {
        cursor: pointer;
        height: 100%;
        position: absolute;
        filter: alpha(opacity=1);
        -moz-opacity: 0;
        opacity: 0;
    }
</style>
@endpush
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ asset('backend/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                            <h2>{{ $user->name }}</h2>
                            {{--                            <div class="social-links mt-2">--}}
                            {{--                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
                            {{--                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
                            {{--                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
                            {{--                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link @if (session('status') === null) active @endif"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button
                                        class="nav-link  @if (session('status') === 'profile-updated') active @endif"
                                        data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link @if (session('status') === 'password-updated') active @endif" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade @if (session('status') === null) show active @endif profile-overview"
                                     id="profile-overview">
                                    {{--                                    <h5 class="card-title">About</h5>--}}
                                    {{--                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>--}}

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone number</div>
                                        <div class="col-lg-9 col-md-8">{{ $user->phone_number }}</div>
                                    </div>


                                </div>

                                <div
                                    class="tab-pane fade @if (session('status') === 'profile-updated') show active @endif profile-edit pt-3"
                                    id="profile-edit">


                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('profile.update') }}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="tab" value="profile-edit">
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img class="ImgPreview" style="width: 120px;height: 120px;object-fit: fill;"
                                                    src="{{ !is_null($user->profile_image) ? $user->profile_image : asset('backend/img/profile-img.jpg') }}"
                                                    alt="Profile">
                                                <div class="pt-2">
                                                    <span class="btn_upload btn btn-primary btn-sm">
                                                        <input type="file" id="imag" title="" class="input-img" name="profile_image"/>
                                                        <i class="bi bi-upload"></i>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name"
                                                       value="{{ $user->name }}">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="email"
                                                   class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                       value="{{ $user->email }}">

                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                                    <div>
                                                        <p class="text-sm mt-2 text-gray-800">
                                                            {{ __('Your email address is unverified.') }}

                                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                {{ __('Click here to re-send the verification email.') }}
                                                            </button>
                                                        </p>

                                                        @if (session('status') === 'verification-link-sent')
                                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                                {{ __('A new verification link has been sent to your email address.') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone_number" class="col-md-4 col-lg-3 col-form-label">Phone
                                                number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone_number" type="text" class="form-control"
                                                       id="phone_number"
                                                       value="{{ $user->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="country_id" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select id="country" class="form-select" name="country_id" onchange="getStates();">
                                                    <option value="">Please Select Country</option>
                                                    @if (!empty($countries) && count($countries) > 0)
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" {{ isset($user->country_id) && $user->country_id == $country->id ? "selected" : ""  }}>{{ $country->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('country_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ isset($user->city_id) ? $user->city_id : 0 }}" id="user_city_id">
                                        <input type="hidden" value="{{ isset($user->state_id) ? $user->state_id : 0 }}" id="user_state_id">
                                        <div class="row mb-3">
                                            <label for="state_id" class="col-md-4 col-lg-3 col-form-label">State</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select id="state" class="form-select" name="state_id" onchange="getCities();">
                                                    <option value="">Please Select State</option>
                                                </select>
                                                @if ($errors->has('state_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('state_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="city_id" class="col-md-4 col-lg-3 col-form-label">City</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select id="city" class="form-select" name="city_id">
                                                    <option value="">Please Select City</option>
                                                </select>
                                                @if ($errors->has('city_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('city_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>


                                <div class="tab-pane fade @if (session('status') === 'password-updated') show active @endif pt-3 " id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{ route('password.update') }}">
                                        @csrf
                                        @method('put')

                                        <div class="row mb-3">
                                            <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control"
                                                       id="current_password">
                                                @if ($errors->has('current_password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('current_password') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                       id="password">
                                                @if ($errors->has('password'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                       id="password_confirmation">
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#country').select2();
        $('#state').select2();
        $('#city').select2();
        if($("#user_state_id").val() != 0 && $("#user_city_id").val() != 0){
            getStates();
            getCities();
        }

        $("#imag").change(function() {

            var imgControlName = ".ImgPreview";
            readURL(this, imgControlName);
        });

        function readURL(input, imgControlName) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $(imgControlName).prop('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    });
    async function getStates() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url = '{{route("backend.pages.profile.getStates")}}';
        var data = {
            'country_id': $("#country").val(),
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if (result['data'] != null) {
                var html = '<option value="">Please Select State</option>';
                $("#state").empty();
                if(result['data'] != null){
                    for (let index = 0; index < result['data'].length; index++) {
                        if($("#user_state_id").val() != 0 && $("#user_state_id").val() == result['data'][index]['id']){
                            html +='<option value='+result['data'][index]['id']+' selected>'+result['data'][index]['name']+'</option>';
                        }else{
                            html +='<option value='+result['data'][index]['id']+'>'+result['data'][index]['name']+'</option>';
                        }
                    }
                    $("#state").append(html);
                    $("#state").select2();
                }
            } else {
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }

    }

    async function getCities() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        const url = '{{route("backend.pages.profile.getCities")}}';
        var data = {
            'state_id': $("#state").val() == "" ? $("#user_state_id").val() : $("#state").val(),
            _token: csrf_token
        };
        try {
            const result = await doAjax(url, data);
            if (result['data'] != null) {
                var html = '<option value="">Please Select City</option>';
                $("#city").empty();
                if(result['data'] != null){
                    for (let index = 0; index < result['data'].length; index++) {
                        if($("#user_city_id").val() != 0 && $("#user_city_id").val() == result['data'][index]['id']){
                            html +='<option value='+result['data'][index]['id']+' selected>'+result['data'][index]['name']+'</option>';
                        }else{
                            html +='<option value='+result['data'][index]['id']+'>'+result['data'][index]['name']+'</option>';
                        }
                    }
                    $("#city").append(html);
                    $("#city").select2();
                }
            } else {
            }
        } catch (error) {
            console.log('Error! InsertAssignments:', error);
        }
    }
</script>
@endpush
