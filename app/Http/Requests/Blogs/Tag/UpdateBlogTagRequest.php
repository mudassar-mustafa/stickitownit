<?php

namespace App\Http\Requests\Blogs\Tag;

use Illuminate\Foundation\Http\FormRequest;


class UpdateBlogTagRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:tags,id,' . $this->id,
            'status' => ['string', 'max:255'],
        ];
    }
}
