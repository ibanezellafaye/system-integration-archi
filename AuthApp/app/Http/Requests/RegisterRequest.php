<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\StrongPassword;


class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s]*$/',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'zip' => 'required|digits:4',
            'password' => ['required', 'string', 'min:8', 'confirmed', new StrongPassword],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
        ]);
    }
}

