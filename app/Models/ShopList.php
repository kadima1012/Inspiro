<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopList extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_list';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idArt',
        'idArtist',
        'item_price',
        'quantity_for_sale',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'idArt', 'idArt');
    }

    /**
     * Get the artist associated with the ShopList.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'idArtist', 'idArtist');
    }

    public function checkQuantityForSale($idArtist)
    {
        $shopListItems = $this->where('idArtist', $idArtist)->get();

        foreach ($shopListItems as $item) {
            $artwork = $item->artwork;

            if ($item->quantity_for_sale > $artwork->art_quantity) {
                return false;
            }
        }

        return true;
    }

}
