<?php

namespace App\Http\Requests\Blogs\Category;

use Illuminate\Foundation\Http\FormRequest;


class UpdateBlogCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:blog_categories,id,' . $this->id,
            'status' => ['string', 'max:255'],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
