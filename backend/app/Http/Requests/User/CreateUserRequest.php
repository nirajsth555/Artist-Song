<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'dob' => 'required|date_format:Y/m/d',
            'gender' => 'required|in:m,f,o',
            'address' => 'required|max:255',
            'role' => 'required|in:super_admin, artist_manager, artist',
        ];
    }
}
