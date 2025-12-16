<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Artwork extends Model
{
    use HasFactory;

    protected $table = 'artwork';

    protected $primaryKey = 'idArt';

    public $timestamps = false;

    protected $fillable = [
        'idArtist',
        'idArtworkType',
        'art_Title',
        'art_Description',
        'art_creation_date',
        'art_Visible',
        'art_Status',
        'filepath',
        'art_quantity',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'idArtist', 'idArtist');
    }

    public function findArtistByArtwork($artworkId)
    {
        $artwork = $this->find($artworkId);

        if ($artwork) {
            return $artwork->artist->artist_name;
        }

        return null;
    }

    public function findArtistIDByArtwork($artworkId)
    {
        $artwork = $this->find($artworkId);

        if ($artwork) {
            return $artwork->idArtist;
        }

        return null;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_artwork', 'idArt', 'idOrder');
    }

    public function artworkType()
    {
        return $this->belongsTo(ArtworkType::class, 'idArtworkType', 'idArtworkType');
    }

    public function getIsInMarketAttribute()
    {
        $user = auth()->user();
        $artist = $this->artist;

        if ($user && $artist) {
            return $this->shopList()
                ->where('idArtist', $artist->idArtist)
                ->exists();
        }

        return false;
    }

    /**
     * Get the shop list items associated with the artwork.
     */
    public function shopList()
    {
        return $this->hasMany(ShopList::class, 'idArt', 'idArt');
    }

    public static function deleteArtworkByArtist($artistId)
    {
        try {
            $artworks = self::where('idArtist', $artistId)->get();

            foreach ($artworks as $artwork) {
                DB::table('shop_list')->where('idArt', $artwork->idArt)->delete();

                $artwork->delete();
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function shopItem()
    {
        return $this->shopList()->where('idArt', $this->idArt)->firstOrFail();
    }

    public static function markAsDeleted($idArt)
    {
        try {
            $artwork = self::find($idArt);

            if ($artwork) {
                $artwork->update([
                    'art_Status' => 'deleted',
                    'art_Visible' => 0,
                ]);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }



}
