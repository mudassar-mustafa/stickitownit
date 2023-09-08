@extends('backend.layouts.app')
@section('title','Create City')
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
                            <h5 class="card-title">Add New City</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.city.store')}}" method="POST">
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
                                    <label for="state_id" class="form-label">State</label>
                                    <select class="state form-select" name="state_id">
                                        <option value=""> Please Select State</option>
                                        @if (!empty($states))
                                            @foreach ($states as $state)
                                                <option value ="{{ $state->id }}" {{ old('state_id') == $state->id ? "selected" : ""  }}>{{ $state->name }}</option>
                                            @endforeach
                                        @endif
                                      </select>
                                    @if ($errors->has('state_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('state_id') }}
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
    $('.state').select2();
});
</script>
@endpush
