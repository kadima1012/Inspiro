<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'artist_first_name' => 'required|string|max:255',
            'artist_last_name' => 'required|string|max:255',
            'artist_description' => 'required|string|max:512',
            'artist_experience' => 'required|integer|min:0',
        ];
    }
}
