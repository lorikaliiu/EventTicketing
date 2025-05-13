<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'preferred_categories' => 'sometimes|array',
            'preferred_categories.*' => 'string|max:255',
        ];

        if ($this->isMethod('patch')) {
            $rules['email'] = 'sometimes|string|email|max:255|unique:users,email,' . $this->user()->id;
            $rules['password'] = 'sometimes|string|min:8';
        }

        return $rules;
    }
}