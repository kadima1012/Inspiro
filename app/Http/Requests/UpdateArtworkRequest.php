<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtworkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'art_Title' => 'required|string|max:50',
            'art_Description' => 'required|string|max:512',
            'art_creation_date' => 'required|date',
            'art_Visible' => 'required|boolean',
            'filepath' => 'nullable|image|max:2048',
            'art_quantity' => 'required|integer|min:1',
            'idArtworkType' => 'required|exists:artwork_type,idArtworkType',
        ];
    }
}
