@extends('backend.layouts.app')
@section('title','Edit Attribute value')
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
                            <h5 class="card-title">Update {{ $attributeValue->name }} Attribute value</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.attribute-value.update',$attributeValue->id)}}"
                                  method="POST">
                                @csrf
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name',$attributeValue->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="attribute_id" class="form-label">Attribute</label>
                                    <select class="attribute form-select" name="attribute_id">
                                        <option value=""> Please Select Attribute</option>
                                        @if (!empty($attributes))
                                            @foreach ($attributes as $attribute)
                                                <option value ="{{ $attribute->id }}" {{ $attributeValue->attribute_id == $attribute->id ? "selected" : ""  }}>{{ $attribute->name }}</option>
                                            @endforeach
                                        @endif
                                      </select>
                                    @if ($errors->has('attribute_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attribute_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="status" class="form-label">Status</label>
                                    <select id="status" class="form-select" name="status">
                                        <option value="active" {{ $attributeValue->status === 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ $attributeValue->status === 'inactive' ? 'selected' : '' }}>
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
@push('scripts')
<script>
    $(document).ready(function() {
    $('.attribute').select2();
});
</script>
@endpush
