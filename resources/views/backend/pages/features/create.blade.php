@extends('backend.layouts.app')
@section('title','Create Feature')
@push('css')
@endpush
@section('content')
    <main id="main" class="main">
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Feature</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.features.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="name" class="form-label">Name <span
                                            class="mandatorySign"> *</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-select" name="status">
                                        <option selected value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <label for="short_description" class="form-label">Short Description <span
                                            class="mandatorySign"> *</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                              id="short_description"
                                              name="short_description">{{ old('short_description') }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="image" class="form-label">{{ __('Image 47 X 46 pixel') }}

                                        <span class="mandatorySign"> *</span></label>
                                    <input value="{{old('image')}}" type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           onchange="readURL(this)" id="image"
                                           name="image" style="padding: 9px; cursor: pointer">
                                    <img width="300" height="200" class="img-thumbnail" style="display:none;"
                                         id="img" src="#"
                                         alt="your image"/>

                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="float-end">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
@endpush
