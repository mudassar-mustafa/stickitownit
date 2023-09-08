<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;


class UpdateFaqRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'short_description' => ['required'],
            'status' => ['string', 'max:255'],
        ];
    }
}
