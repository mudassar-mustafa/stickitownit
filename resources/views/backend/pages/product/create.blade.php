@extends('backend.layouts.app')
@section('title','Create Product')
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
                            <h5 class="card-title">Add New Product</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{route('backend.pages.product.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="main_image" class="form-label">{{ __('Main Image 300 X 300 pixel') }}
                                        <span class="mandatorySign"> *</span>
                                    </label>
                                    <input value="{{old('main_image')}}" type="file"
                                        class="form-control @error('main_image') is-invalid @enderror"
                                        onchange="readURL(this)" id="main_image"
                                        name="main_image" style="padding: 9px; cursor: pointer">
                                    <img  class="img-thumbnail" style="display:none; height: 100px !important;"
                                         id="img" src="#"
                                         alt="your main_image"/>
                                    @error('main_image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <input type="text" class="form-control" id="short_description" name="short_description"
                                           value="{{ old('short_description') }}">
                                    @if ($errors->has('short_description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="tinymce-editor description" name="description">
                                        {!! old('description') !!}
                                      </textarea>
                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="category_id form-select" name="category_id[]">
                                        <option value=""> Please Select Category</option>
                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <option value ="{{ $category->id }}" {{ old('category_id') == $category->id ? "selected" : ""  }}>{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                      </select>
                                    @if ($errors->has('category_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('category_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select class="brand_id form-select" name="brand_id">
                                        <option value=""> Please Select Brand</option>
                                        @if (!empty($brands))
                                            @foreach ($brands as $brand)
                                                <option value ="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? "selected" : ""  }}>{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                      </select>
                                    @if ($errors->has('brand_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('brand_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="product_type" class="form-label">Product Type</label>
                                    <select id="product_type" class="form-select" name="product_type" onchange="getProductFields()">
                                        <option value="" {{ old('product_type') == "" ? "selected" : "" }}>Please Select Product Type</option>
                                        <option value="normal" {{ old('product_type') == "normal" ? "selected" : "" }}>Normal</option>
                                        <option value="variation" {{ old('product_type') == "variation" ? "selected" : "" }}>Variation</option>
                                    </select>
                                    @if ($errors->has('product_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('product_type') }}
                                        </div>
                                    @endif
                                </div>
                                @include('backend.pages.product.partial.normal_partial')
                                @include('backend.pages.product.partial.attribute_partial')
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 appendAttributeValues">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden variation_product_fields">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="auto_combination" onchange="getAutoCombination()">
                                        <label class="form-check-label" for="gridCheck1">
                                          Auto Combination
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 append_combinations hidden variation_product_fields">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                            Visibility
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                            Combination
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            Qunatity
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            Price
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                            Sku
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                            Image
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                            Action
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <label for="shipping_type" class="form-label">Shipping Type</label>
                                    <select id="shipping_type" class="form-select" name="shipping_type" onchange="getShippingFields()">
                                        <option value="" {{ old('shipping_type') == "" ? "selected" : "" }}>Please Shipping Type</option>
                                        <option value="free" {{ old('shipping_type') == "free" ? "selected" : "" }}>Free</option>
                                        <option value="fixed" {{ old('shipping_type') == "fixed" ? "selected" : "" }}>Flat Shipping</option>
                                    </select>
                                    @if ($errors->has('shipping_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('shipping_type') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden shipping_fields">
                                    <label for="shipping_fee" class="form-label">Shipping Fee</label>
                                    <input type="number" step="any" class="form-control" id="shipping_fee" name="shipping_fee"
                                           value="{{ old('shipping_fee') }}">
                                    @if ($errors->has('shipping_fee'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('shipping_fee') }}
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
    var attributeArray = [];
    $(document).ready(function() {
        $('.category_id').select2();
        $('.brand_id').select2();
        $('.attribute_id').select2({
            placeholder: "Select Attribute",
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                return null;
                }

                return {
                id: term[0].toUpperCase() + term.slice(1),
                text: term[0].toUpperCase() + term.slice(1),
                newTag: true // add additional parameters
                }
            }
        });

        $('.attribute_id').on('select2:select', function (e) {

            var data = e.params.data.text;
            getAttributeValue(data);
            var attribute = [];
            attribute.push(data);
            attribute.push(null);
            attributeArray.push(attribute);
        });
        $('.attribute_id').on('select2:unselect', function (e) {

            var data = e.params.data.text;
            attributeArray = $.grep(attributeArray, function(n) {
                return n[0] != data;
            });
            $(".attribure_value"+data+"").remove();
        });
    });

    function getProductFields(){
        if( $('#product_type').find(":selected").val() == "normal"){
            $(".normal_product_fields").removeClass('hidden');
            $(".variation_product_fields").addClass('hidden');
        }else{
            $(".normal_product_fields").addClass('hidden');
            $(".variation_product_fields").removeClass('hidden');
        }
    }

    function getShippingFields(){
        if( $('#shipping_type').find(":selected").val() == "free"){
            $(".shipping_fields").addClass('hidden');
        }else{
            $(".shipping_fields").removeClass('hidden');
        }
    }

    function getAttributeValue(data) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            async: false,
            url: '{{route("backend.pages.product.getAttributeValues")}}',
            data: {
            attribute_name: data,
            _token: csrf_token
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'success') {
                    if(data.data.getAttributeValueHtml != ''){
                        $(".appendAttributeValues").append(data.data.getAttributeValueHtml);
                    }
                    $('.attribute_value_id'+ data.data.attributeName +'').select2({
                        placeholder: "Select Attribute Value",
                        tags: true,
                        createTag: function (params) {
                            var term = $.trim(params.term);

                            if (term === '') {
                            return null;
                            }

                            return {
                            id: term[0].toUpperCase() + term.slice(1),
                            text: term[0].toUpperCase() + term.slice(1),
                            newTag: true // add additional parameters
                            }
                        }
                    });
                }
            }
        });   
    }

    function updateAttributeValueArray(attributeName){
        var data = $(".attribute_value_id"+attributeName+"").val();
        for(var i = 0; i<attributeArray.length; i++ ){
            if(attributeArray[i][0] == attributeName){
                attributeArray[i][1] = data;
                return;
            }
        }
    }

    function getAutoCombination() {
        if ($("#auto_combination").is(':checked')) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            async: false,
            url: '{{route("backend.pages.product.getCombination")}}',
            data: {
                attributeArray: attributeArray,
                _token: csrf_token
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'success') {
                    if(data.data != ''){
                        $(".append_combinations").append(data.data);
                    }
                }
            }
        });
        }else{
            $(".remove_combinations").remove();
        }
        
    }


</script>
@endpush
