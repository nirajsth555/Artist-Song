<?php

namespace App\Http\Requests\Music;

use Illuminate\Foundation\Http\FormRequest;

class CreateMusicRequest extends FormRequest
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
            'artist' => 'required',
            'title' => 'required|max:255',
            'album_name' => 'required|max:255',
            'genre' => 'required|in:rnb, country, classic, rock, jazz',
        ];
    }
}
