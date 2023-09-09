@extends('backend.layouts.app')
@section('title','Create Package')
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
                            <h5 class="card-title">Add New Package</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.package.store')}}" method="POST">
                                @csrf
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="any" class="form-control" id="price" name="price"
                                           value="{{ old('price') }}">
                                    @if ($errors->has('price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="token" class="form-label">Token</label>
                                    <input type="number" step="any" class="form-control" id="token" name="token"
                                           value="{{ old('token') }}">
                                    @if ($errors->has('token'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('token') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="package_type" class="form-label">Package Type</label>
                                    <select class="package_type form-select" name="package_type">
                                        <option value="" {{ old('package_type') == "" ? "selected" : ""  }}> Please Select Package Type</option>
                                        <option value="weekly" {{ old('package_type') == "weekly" ? "selected" : ""  }}> Weekly</option>
                                        <option value="monthly" {{ old('package_type') == "monthly" ? "selected" : ""  }}> Monthly</option>
                                        <option value="quartely" {{ old('package_type') == "quartely" ? "selected" : ""  }}> Quartely</option>
                                        <option value="yearly" {{ old('package_type') == "yearly" ? "selected" : ""  }}> Yearly</option>
                                        
                                      </select>
                                    @if ($errors->has('package_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('package_type') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
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
<script>
    $(document).ready(function() {
    $('.package_type').select2();
});
</script>
@endpush
