@extends('backend.layouts.app')
@section('title','Create Blog')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
@endpush
@section('content')
    <main id="main" class="main">
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Blog</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.blogs.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="media_blog_id" value="{{$blog_id}}">
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
                                    <label for="title" class="form-label">Title <span
                                            class="mandatorySign"> *</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title"
                                           value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="categories"
                                           class="form-label">{{ __('Category') }}
                                        <span class="mandatorySign">*</span></label>

                                    <select id="categories"
                                            class="form-control categories {{ $errors->has('categories') ? '  is-invalid' : '' }}"
                                            name="categories[]" autocomplete="categories" multiple>
                                        <option value="" id="one">Select an option</option>
                                        @if(!empty($categories))
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{ (old('categories') == $category->id) ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if($errors->has('categories'))
                                        <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('categories') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="tags"
                                           class="form-label">{{ __('Tags') }}
                                        <span class="mandatorySign">*</span></label>

                                    <select id="tags"
                                            class="form-control tags {{ $errors->has('tags') ? '  is-invalid' : '' }}"
                                            name="tags[]" autocomplete="tags" multiple>
                                        <option value="" id="one">Select an option</option>
                                        @if(!empty($tags))
                                            @foreach($tags as $tag)
                                                <option
                                                    value="{{$tag->id}}" {{ (old('tags') == $tag->id) ? 'selected' : ''}}>{{$tag->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if($errors->has('tags'))
                                        <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('tags') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <label for="summary"
                                           class="form-label">{{ __('Summary') }}
                                        <span class="mandatorySign">*</span></label>

                                    <textarea id="summary"
                                              class="form-control @error('summary') is-invalid @enderror"
                                              name="summary"
                                              style="height: 200px !important;"
                                              autocomplete="summary">{{ old('summary') }}</textarea>

                                    @error('summary')
                                    <span class="invalid-feedback" role="alert">
                                              {{ $message }}
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <label for="description"
                                           class="form-label">{{ __('Description') }}
                                        <span class="mandatorySign">*</span></label>

                                    <textarea id="description"
                                              class="form-control tinymce-editor @error('description') is-invalid @enderror"
                                              name="description"
                                              style="height: 200px !important;"
                                              autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                              {{ $message }}
                                            </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <label for="is_featured"
                                           class="form-label">{{ __('Is Featured') }}
                                        <span
                                            class="mandatorySign">*</span></label>

                                    <select id="is_featured"
                                            class="form-control @error('is_featured') is-invalid @enderror"
                                            name="is_featured" autocomplete="is_featured">
                                        <option
                                            value="yes" {{ (old('is_featured') == 'yes') ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option
                                            value="no" {{ (old('is_featured') == 'no') ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>

                                    @error('is_featured')
                                    <span class="invalid-feedback" role="alert">
                                                 {{ $message }}
                                                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                    <label for="is_order"
                                           class="form-label">{{ __('Is Order') }}
                                        <span
                                            class="mandatorySign">*</span></label>

                                    <select id="is_order"
                                            class="form-control @error('is_order') is-invalid @enderror"
                                            name="is_order" autocomplete="is_order">
                                        <option
                                            value="0" {{ (old('is_order') == '0') ? 'selected' : '' }}>
                                            0
                                        </option>
                                        <option
                                            value="1" {{ (old('is_order') == '1') ? 'selected' : '' }}>
                                            1
                                        </option>
                                        <option
                                            value="2" {{ (old('is_order') == '2') ? 'selected' : '' }}>
                                            2
                                        </option>
                                        <option
                                            value="3" {{ (old('is_order') == '3') ? 'selected' : '' }}>
                                            3
                                        </option>
                                    </select>

                                    @error('is_order')
                                    <span class="invalid-feedback" role="alert">
                                                  {{ $message }}
                                                </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
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
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="image" class="form-label">{{ __('Image 330 X 408 pixel') }}

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
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="author_name"
                                           class="form-label">{{ __('Author Name') }}
                                        <span
                                            class="mandatorySign">*</span></label>

                                    <input id="author_name" type="text"
                                           class="form-control @error('author_name') is-invalid @enderror"
                                           name="author_name"
                                           value="{{ old('author_name') }}" autocomplete="author_name">

                                    @error('author_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <div class="card mb-4">
                                        <div class="card-header"><strong>Galleries</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div id="dropzoneForm" class="dropzone">
                                                    <input type="hidden" value="{{$blog_id}}" id="blog_id"
                                                           name="blog_id">
                                                </div>
                                                <div class="float-end mt-2">
                                                    <button type="button" class="btn btn-dark float-end"
                                                            id="submit-all">Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header"><strong>Uploaded Images</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="card-body">
                                                    <div class="example" id="uploaded_image">
                                                        <div class="row">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="meta_title"
                                           class="form-label">{{ __('Meta Title') }} </label>

                                    <input id="meta_title" type="text"
                                           class="form-control @error('meta_title') is-invalid @enderror"
                                           name="meta_title"
                                           value="{{ old('meta_title') }}" autocomplete="meta_title">

                                    @error('meta_title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="meta_keywords"
                                           class="form-label">{{ __('Meta Keywords') }}</label>

                                    <input id="meta_keywords" type="text"
                                           class="form-control @error('meta_keywords') is-invalid @enderror"
                                           name="meta_keywords"
                                           value="{{ old('meta_keywords') }}" autocomplete="meta_keywords">

                                    @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                    <label for="meta_description"
                                           class="form-label">{{ __('Meta Description') }}</label>

                                    <textarea id="meta_description"
                                              class="form-control @error('meta_description') is-invalid @enderror"
                                              name="meta_description"

                                              autocomplete="meta_description">{{ old('meta_description') }}</textarea>

                                    @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                              {{ $message }}
                                            </span>
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
    <style>
        .remove_image {
            background: var(--bs-link-color);
            margin-top: 10px;
            color: white;
            text-decoration: none;
            display: grid;
            width: 100%;
        }
        .mr-2{
            margin-right: 2px;
        }
        .btn-link:hover {
            color: #ffffff;
        }
    </style>

    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            url: "{{ route('backend.pages.blogs.media.upload') }}",
            autoProcessQueue: false,
            parallelUploads: 10,
            maxFilesize: 5,
            acceptedFiles: ".png,.jpg,.jpeg",

            init: function () {
                var submitButton = document.querySelector("#submit-all");
                myDropzone = this;

                this.on("thumbnail", function (file) {
                    if (file.size <= 1024 * 1024 * 1024 * 1024 * 1024) {

                    } else {
                        $('.loading').hide();
                        toastr.error("Maximum upload file size is 5mb.");
                    }
                });

                submitButton.addEventListener('click', function () {
                    $('.loading').show();
                    // enable auto process queue after uploading started
                    myDropzone.options.autoProcessQueue = true;
                    // queue processing
                    myDropzone.processQueue();
                });
                this.on('sendingmultiple', function (data, xhr, formData) {

                    formData.append("blog_id", $("#blog_id").val());
                });

                this.on("complete", function () {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    load_images();
                });
                // disable queue auto processing on upload complete
                this.on("queuecomplete", function () {
                    myDropzone.options.autoProcessQueue = false;
                });


            }

        };


        function load_images() {
            $.ajax({
                url: "{{ route('backend.pages.blogs.media.fetch',$blog_id) }}",
                success: function (data) {
                    $('#uploaded_image').html(data);
                    $('.loading').hide();
                }
            })
        }

        $(document).on('click', '.remove_image', function () {
            $('.loading').show();
            var id = $(this).attr('id');
            var name = $(this).attr('data-name');
            $.ajax({
                url: "{{ route('backend.pages.blogs.media.delete') }}",
                data: {name: name, id: id},
                success: function (data) {
                    load_images();
                }
            })
        });

    </script>
    <script>
        //Initialize Select2 Elements
        $('#one').prop('disabled', !$('#one').prop('disabled'));

        //Initialize Select2 Elements
        $('.categories').select2();
        $('.tags').select2();
    </script>

@endpush
