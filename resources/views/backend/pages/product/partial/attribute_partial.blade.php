<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 {{ !empty($product) && $product->product_type == "variation" ? "" : "hidden" }} variation_product_fields">
    @php
        $attributesArray = [];
        $attributeNameString = "";
        if(!empty($product) && !empty($product->attributes)){
            $attributesArray = $product->attributes->pluck('name')->toArray();
            $attributeNameString = implode(',', $attributesArray);
        }else{
            array_push($attributesArray, old('attribute_id'));
        }

    @endphp
    <input type="hidden" value="{{ $attributeNameString }}" id = "attribute_name_string"> 
    <label for="attribute_id" class="form-label">Attribute</label>
    <select class="attribute_id form-select" name="attribute_ids[]" multiple="multiple">
        @if (!empty($attributes))
            @foreach ($attributes as $attribute)
                <option value ="{{ $attribute->name }}" {{ in_array($attribute->name, $attributesArray) ? "selected" : ""  }}>{{ $attribute->name }}</option>
            @endforeach
        @endif
      </select>
    @if ($errors->has('attribute_id'))
        <div class="invalid-feedback">
            {{ $errors->first('attribute_id') }}
        </div>
    @endif
</div>