<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'idArtist', 'idArtist');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_artwork', 'idArt', 'idOrder');
    }

    public function artworkType(): BelongsTo
    {
        return $this->belongsTo(ArtworkType::class, 'idArtworkType', 'idArtworkType');
    }

    public function shopList(): HasMany
    {
        return $this->hasMany(ShopList::class, 'idArt', 'idArt');
    }

    public function getIsInMarketAttribute(): bool
    {
        return $this->shopList()->exists();
    }

    public function findArtistByArtwork(int $artworkId): ?string
    {
        $artwork = $this->find($artworkId);

        return $artwork?->artist?->full_name;
    }

    public function findArtistIDByArtwork(int $artworkId): ?int
    {
        $artwork = $this->find($artworkId);

        return $artwork?->idArtist;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('art_Status', 'Active');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('art_Visible', 1);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('art_Status', 'Pending');
    }

    public static function deleteArtworkByArtist(int $artistId): bool
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

    public static function markAsDeleted(int $idArt): bool
    {
        $artwork = self::find($idArt);

        if ($artwork) {
            $artwork->update([
                'art_Status' => 'deleted',
                'art_Visible' => 0,
            ]);

            return true;
        }

        return false;
    }
}
