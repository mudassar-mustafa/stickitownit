<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden variation_product_fields">
    <label for="attribute_id" class="form-label">Attribute</label>
    <select class="attribute_id form-select" name="attribute_ids[]" multiple="multiple">
        @if (!empty($attributes))
            @foreach ($attributes as $attribute)
                <option value ="{{ $attribute->name }}" {{ old('attribute_id') == $attribute->name ? "selected" : ""  }}>{{ $attribute->name }}</option>
            @endforeach
        @endif
      </select>
    @if ($errors->has('attribute_id'))
        <div class="invalid-feedback">
            {{ $errors->first('attribute_id') }}
        </div>
    @endif
</div>