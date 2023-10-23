@extends('backend.layouts.app')
@section('title','Edit Page')
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
                            <h5 class="card-title">Update {{ $page->name }} Page</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.page.update',$page->id)}}"
                                  method="POST">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name',$page->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <input type="text" class="form-control" id="excerpt" name="excerpt"
                                           value="{{ old('excerpt',$page->excerpt) }}">
                                    @if ($errors->has('excerpt'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('excerpt') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="body" class="form-label">Body</label>
                                    <textarea class="tinymce-editor body" name="body">
                                        {!! old('body', $page->body) !!}
                                      </textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('body') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="meta_description" class="form-label">Meta Decription</label>
                                    <textarea class="form-control" placeholder="Meta Description" id="floatingTextarea" name="meta_description" style="height: 100px;">
                                        {{ old('meta_description',$page->meta_decription) }}
                                    </textarea>
                                    @if ($errors->has('meta_description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                    <textarea class="form-control" placeholder="Meta Keyword" id="floatingTextarea" name="meta_keyword" style="height: 100px;">
                                        {{ old('meta_keyword',$page->meta_keyword) }}
                                    </textarea>
                                    @if ($errors->has('meta_keyword'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_keyword') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-select" name="status">
                                        <option value="active" {{ $page->status === 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ $page->status === 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
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
