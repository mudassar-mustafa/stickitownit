<?php

namespace App\Http\Requests\State;
use Illuminate\Foundation\Http\FormRequest;


class UpdateStateRequest extends FormRequest
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
            'abrv' => ['string', 'max:255'],
            'country_id' => ['required'],
            'status' => ['string', 'max:255'],
        ];
    }
}
