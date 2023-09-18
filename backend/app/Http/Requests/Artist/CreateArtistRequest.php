<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class CreateArtistRequest extends FormRequest
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
            'name' => 'required|max:255',
            'dob' => 'required|date_format:Y/m/d',
            'gender' => 'required|in:m,f,o',
            'address' => 'required|max:255',
            'first_release_year' => 'required|date_format:Y',
            'no_of_albums_released' => 'required|integer',
        ];
    }
}
