<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopList extends Model
{
    use HasFactory;

    protected $table = 'shop_list';

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = [
        'idArt',
        'idArtist',
        'item_price',
        'quantity_for_sale',
    ];

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class, 'idArt', 'idArt');
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'idArtist', 'idArtist');
    }

    public function checkQuantityForSale(int $idArtist): bool
    {
        $shopListItems = self::where('idArtist', $idArtist)->with('artwork')->get();

        foreach ($shopListItems as $item) {
            if ($item->artwork && $item->quantity_for_sale > $item->artwork->art_quantity) {
                return false;
            }
        }

        return true;
    }
}
