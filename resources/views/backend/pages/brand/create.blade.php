@extends('backend.layouts.app')
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
                          <h5 class="card-title">Add New Brand</h5>
            
                          <!-- Vertical Form -->
                          <form class="row g-3" action="{{route('backend.pages.brand.store')}}" method="POST">
                            @csrf
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
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
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
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