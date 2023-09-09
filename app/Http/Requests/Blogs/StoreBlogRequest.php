<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:blogs'],
            'status' => ['string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'summary' => 'required',
            'description' => 'required',
            "categories" => "required|array",
            "tags" => "required|array",
            "author_name" => "required",
            "title" => "required",
            "is_featured" => "nullable",
            "is_order" => "nullable",
            "meta_title" => "nullable",
            "meta_description" => "nullable",
            "meta_keywords" => "nullable",
            "media_blog_id" => "nullable",
        ];
    }
}
