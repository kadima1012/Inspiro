<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtworkType extends Model
{
    use HasFactory;

    protected $table = 'artwork_type';

    protected $primaryKey = 'idArtworkType';

    protected $fillable = [
        'type_name'
    ];

    public static function getIdByTypeName($typeName)
    {
        $artworkType = self::where('type_name', $typeName)->first();

        return $artworkType ? $artworkType->idArtworkType : null;
    }
}
