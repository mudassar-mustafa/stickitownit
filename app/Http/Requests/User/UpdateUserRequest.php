<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;


class UpdateUserRequest extends FormRequest
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
                'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
                'status' => ['string', 'max:255'],
                'phone_number' => ['required'],
                'cnic' => ['required'],
                'password' => $this->has('password') && !is_null($this->password) ? ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()] : ['nullable']
            ];


    }
}
