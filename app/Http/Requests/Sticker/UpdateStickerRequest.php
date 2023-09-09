<?php

namespace App\Http\Requests\Sticker;

use Illuminate\Foundation\Http\FormRequest;


class UpdateStickerRequest extends FormRequest
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
            'image' => ['mimes:jpg,jpeg,png|max:2048'],
            'status' => ['string', 'max:255'],
        ];
    }
}
