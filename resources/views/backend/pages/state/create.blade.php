@extends('backend.layouts.app')
@section('title','Create State')
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
                            <h5 class="card-title">Add New State</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.state.store')}}" method="POST">
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
                                    <label for="abrv" class="form-label">Abrv</label>
                                    <input type="text" class="form-control" id="abrv" name="abrv"
                                           value="{{ old('abrv') }}">
                                    @if ($errors->has('abrv'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('abrv') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select class="country form-select" name="country_id">
                                        <option value=""> Please Select Country</option>
                                        @if (!empty($countries))
                                            @foreach ($countries as $country)
                                                <option value ="{{ $country->id }}" {{ old('country_id') == $country->id ? "selected" : ""  }}>{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                      </select>
                                    @if ($errors->has('country_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('country_id') }}
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
    $('.country').select2();
});
</script>
@endpush
