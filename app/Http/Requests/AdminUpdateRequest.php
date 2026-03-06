<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('admin');
    }

    public function rules(): array
    {
        $entityType = $this->route('entityType');

        return match ($entityType) {
            'user' => [
                'id' => 'required|integer|exists:users,idUser',
                'user_first_name' => 'required|string|max:255',
                'user_last_name' => 'required|string|max:255',
                'user_username' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ],
            'artist' => [
                'id' => 'required|integer|exists:artist,idArtist',
                'artist_first_name' => 'required|string|max:255',
                'artist_last_name' => 'required|string|max:255',
                'artist_description' => 'required|string|max:512',
                'artist_experience' => 'required|integer|min:0',
            ],
            'artwork' => [
                'id' => 'required|integer|exists:artwork,idArt',
                'art_Title' => 'required|string|max:50',
                'art_Description' => 'required|string|max:512',
                'art_creation_date' => 'required|date',
                'art_Visible' => 'nullable|boolean',
                'art_Status' => 'required|string|max:50',
            ],
            'shoplist' => [
                'idArt' => 'required|integer',
                'idArtist' => 'required|integer',
                'quantity_for_sale' => 'required|integer|min:0',
                'item_price' => 'required|numeric|min:0',
            ],
            'order' => [
                'id' => 'required|integer|exists:orders,idOrder',
                'order_status' => 'required|string|max:50',
                'order_details' => 'nullable|string|max:512',
            ],
            default => [],
        };
    }
}
