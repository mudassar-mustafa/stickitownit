<div class="row attribure_value{{ $attributeName }}">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ $attributeName }}
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <label for="attribute_value_id{{ $attributeName }}" class="form-label">Attribute Value</label>
        <select class="attribute_value_id{{ $attributeName }} form-select" name="attribute_value_id{{ $attributeName }}[]" multiple="multiple" onchange="updateAttributeValueArray('{{ $attributeName }}')">
            @if (!empty($attributeValues))
                @foreach ($attributeValues as $attributeValue)
                    <option value ="{{ $attributeValue->name }}" {{ in_array($attributeValue->name, $attributeSelectedValues) ? "selected" : ""  }}>{{ $attributeValue->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>