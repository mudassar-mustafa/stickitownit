@extends('backend.layouts.app')
@section('title','Create Page')
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
                            <h5 class="card-title">Add New Page</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.page.store')}}" method="POST">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <input type="text" class="form-control" id="excerpt" name="excerpt"
                                           value="{{ old('excerpt') }}">
                                    @if ($errors->has('excerpt'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('excerpt') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="body" class="form-label">Body</label>
                                    <textarea class="body" id="description" name="body">{!! old('body') !!}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('body') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="meta_description" class="form-label">Meta Decription</label>
                                    <textarea class="form-control" placeholder="Meta Description" id="floatingTextarea" name="meta_description" style="height: 100px;">{{ old('meta_description') }}</textarea>
                                    @if ($errors->has('meta_description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    <textarea class="form-control" placeholder="Meta Keyword" id="floatingTextarea" name="meta_keyword" style="height: 100px;">{{ old('meta_keyword') }}</textarea>
                                    @if ($errors->has('meta_keyword'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_keyword') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
          integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"
            integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#description').summernote({
                fontSizes: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['font', ['fontname']],
                    ['para', ['paragraph', 'ul', 'ol']],
                    ['insert', ['link', 'image', 'doc', 'video', 'picture', 'hr']], // image and doc are customized buttons
                    ['misc', ['codeview', 'fullscreen']],
                ],
                height: 400,
            });
            var noteBar = $('.note-toolbar');
            noteBar.find('[data-toggle]').each(function () {
                $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
            });
        });
    </script>
@endpush
