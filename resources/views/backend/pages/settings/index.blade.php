@extends('backend.layouts.app')
@section('title','Settings')
@push('css')
@endpush
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Settings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">

                        <div class="card-body pt-3">
                            @if (session('status') === 'general-settings' || session('status') === 'social-settings' || session('status') === 'banner-settings')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600" style="color: green"
                                >{{ __('Settings updated successfully.') }}</p>
                            @endif
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link @if (session('status') === null || session('status') === 'general-settings') active @endif"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">General Settings
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button
                                        class="nav-link  @if (session('status') === 'banner-settings') active @endif"
                                        data-bs-toggle="tab" data-bs-target="#profile-edit">Banner Settings
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        class="nav-link @if (session('status') === 'social-settings') active @endif"
                                        data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Social Links
                                    </button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div
                                    class="tab-pane fade @if (session('status') === null || session('status') === 'general-settings') show active @endif profile-overview"
                                    id="profile-overview">
                                    <!-- Profile Edit Form -->
                                    <form method="post" action="{{ route('backend.settings.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tab" value="general_settings">
                                        <div class="row mb-3">
                                            <label for="logo_header" class="col-md-4 col-lg-3 col-form-label">Logo
                                                Header</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img
                                                    style="width: 20%"
                                                    src="{{ !is_null($setting->logo_header) ? asset('storage/uploads/settings/'.$setting->logo_header) : asset('backend/img/profile-img.jpg') }}"
                                                    alt="Profile">
                                                <div class="pt-2">
                                                    <input type="file" name="logo_header" id="logo_header">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="logo_footer" class="col-md-4 col-lg-3 col-form-label">Logo
                                                Footer</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img
                                                    src="{{ !is_null($setting->logo_footer) ? asset('storage/uploads/settings/'.$setting->logo_footer) : asset('backend/img/profile-img.jpg') }}"
                                                    style="width: 20%"
                                                    alt="Profile">
                                                <div class="pt-2">
                                                    <input type="file" name="logo_footer" id="logo_footer">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company_name" class="col-md-4 col-lg-3 col-form-label">Company
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company_name" type="text" class="form-control"
                                                       id="company_name"
                                                       value="{{ $setting->company_name }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="company_short_description"
                                                   class="col-md-4 col-lg-3 col-form-label">Company Short
                                                Description</label>
                                            <div class="col-md-8 col-lg-9">
                                            <textarea name="company_short_description" type="text" class="form-control"
                                                      id="company_short_description">{{ $setting->company_short_description }}</textarea>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="email"
                                                   class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email"
                                                       value="{{ $setting->email }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone_number" class="col-md-4 col-lg-3 col-form-label">Phone
                                                number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone_number" type="text" class="form-control"
                                                       id="phone_number"
                                                       value="{{ $setting->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="address"
                                                   class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control"
                                                       id="address"
                                                       value="{{ $setting->address }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="office_hours" class="col-md-4 col-lg-3 col-form-label">Office
                                                Hours</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="office_hours" type="text" class="form-control"
                                                       id="office_hours"
                                                       value="{{ $setting->office_hours }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="office_working_days" class="col-md-4 col-lg-3 col-form-label">Office
                                                Working Days</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="office_working_days" type="text" class="form-control"
                                                       id="office_working_days"
                                                       value="{{ $setting->office_working_days }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="number_of_images" class="col-md-4 col-lg-3 col-form-label">Number Of Images</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="number_of_images" type="text" class="form-control"
                                                       id="number_of_images"
                                                       value="{{ $setting->number_of_images }}">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>

                                <div
                                    class="tab-pane fade @if (session('status') === 'banner-settings') show active @endif profile-edit pt-3"
                                    id="profile-edit">


                                    <!-- Profile Edit Form -->
                                    <form method="post" action="{{ route('backend.settings.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tab" value="banner_settings">
                                        <div class="row mb-3">
                                            <label for="banner_one" class="col-md-4 col-lg-3 col-form-label">Banner
                                                1</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img
                                                    src="{{ !is_null($setting->banner_one) ? asset('storage/uploads/settings/'.$setting->banner_one) : asset('backend/img/profile-img.jpg') }}"
                                                    style="width: 20%"
                                                    alt="Profile">
                                                <div class="pt-2">
                                                    <input type="file" name="banner_one" id="banner_one">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="banner_two" class="col-md-4 col-lg-3 col-form-label">Banner
                                                2</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img
                                                    src="{{ !is_null($setting->banner_two) ? asset('storage/uploads/settings/'.$setting->banner_two) : asset('backend/img/profile-img.jpg') }}"
                                                    style="width: 20%"
                                                    alt="Profile">
                                                <div class="pt-2">
                                                    <input type="file" name="banner_two" id="banner_two">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="banner_tag_line" class="col-md-4 col-lg-3 col-form-label">Banner
                                                Tag line</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="banner_tag_line" type="text" class="form-control"
                                                       id="banner_tag_line"
                                                       value="{{ $setting->banner_tag_line }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="banner_tag_line_description"
                                                   class="col-md-4 col-lg-3 col-form-label">Banner Tag
                                                Description</label>
                                            <div class="col-md-8 col-lg-9">
                                            <textarea name="banner_tag_line_description" type="text"
                                                      class="form-control"
                                                      id="banner_tag_line_description">{{ $setting->banner_tag_line_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>


                                <div
                                    class="tab-pane fade @if (session('status') === 'social-settings') show active @endif"
                                    id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{ route('backend.settings.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tab" value="social_settings">
                                        <div class="row mb-3">
                                            <label for="facebook_url" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook_url" type="text" class="form-control"
                                                       id="facebook_url"
                                                       value="{{ $setting->facebook_url }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="twitter_url" class="col-md-4 col-lg-3 col-form-label">Twitter
                                                URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter_url" type="text" class="form-control"
                                                       id="twitter_url"
                                                       value="{{ $setting->twitter_url }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="instagram_url" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram_url" type="text" class="form-control"
                                                       id="instagram_url"
                                                       value="{{ $setting->instagram_url }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="youtube_url" class="col-md-4 col-lg-3 col-form-label">Youtube
                                                URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="youtube_url" type="text" class="form-control"
                                                       id="youtube_url"
                                                       value="{{ $setting->youtube_url }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="linkedin_url" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                URL</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedin_url" type="text" class="form-control"
                                                       id="linkedin_url"
                                                       value="{{ $setting->linkedin_url }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
@endpush
