<?php

namespace App\Http\Requests\Page;
use Illuminate\Foundation\Http\FormRequest;


class UpdatePageRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:pages,id,' . $this->id,
            'excerpt' => ['required', 'string'],
            'body' => ['required'],
            'status' => ['string', 'max:255'],
        ];
    }
}
