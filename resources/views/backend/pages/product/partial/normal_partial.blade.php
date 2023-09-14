<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden normal_product_fields">
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity"
           value="{{ old('quantity') }}">
    @if ($errors->has('quantity'))
        <div class="invalid-feedback">
            {{ $errors->first('quantity') }}
        </div>
    @endif
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden normal_product_fields">
    <label for="price" class="form-label">Price</label>
    <input type="number" step="any" class="form-control" id="price" name="price"
           value="{{ old('price') }}">
    @if ($errors->has('price'))
        <div class="invalid-feedback">
            {{ $errors->first('price') }}
        </div>
    @endif
</div>