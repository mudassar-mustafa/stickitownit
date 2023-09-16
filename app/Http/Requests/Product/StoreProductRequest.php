<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category_id' => ['nullable'],
            'brand_id' => ['required'],
            'product_type' => ['required'],
            'quantity' => ['required_if:product_type,normal', 'numeric'],
            'price' => ['required_if:product_type,normal', 'numeric'],
            'attribute_ids.*' => ['required_if:product_type,variation'],
            'status' => ['string', 'max:255'],
        ];
    }
}
