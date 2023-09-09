@extends('backend.layouts.app')
@section('title','Create Sticker')
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
                            <h5 class="card-title">Add New Sticker</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.sticker.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="image" class="form-label">{{ __('Image 300 X 300 pixel') }}
                                        <span class="mandatorySign"> *</span>
                                    </label>
                                    <input value="{{old('image')}}" type="file"
                                        class="form-control @error('image') is-invalid @enderror"
                                        onchange="readURL(this)" id="image"
                                        name="image" style="padding: 9px; cursor: pointer">
                                    <img width="300" height="300" class="img-thumbnail" style="display:none;"
                                         id="img" src="#"
                                         alt="your image"/>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
