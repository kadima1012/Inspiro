<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderArtwork extends Model
{
    use HasFactory;

    protected $table = 'order_artwork';

    protected $primaryKey = 'id'; 

    public $incrementing = true; 

    protected $fillable = [
        'idArt',
        'idOrder',
        'quantity_to_order'
    ];

    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'idArt');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'idOrder');
    }

    public function checkQuantityToOrder($idArt)
    {
        $orderItems = $this->where('idArt', $idArt)->get();

        foreach ($orderItems as $item) {
            $artwork = $item->artwork;

            if ($item->quantity_to_order > $artwork->quantity_for_sale) {
                return false;
            }
        }

        return true;
    }

    public static function updateOrderArtwork($idArt, $idOrder, $quantity)
    {
        $orderArtwork = self::where('idArt', $idArt)
                            ->where('idOrder', $idOrder)
                            ->first();
    
        if ($orderArtwork) {
            $orderArtwork->update(['quantity_to_order' => $orderArtwork->quantity_to_order + $quantity]);
            return $orderArtwork;
        }
    
        return null;
    }
    
    public static function findByArtId($idArt)
    {
    return self::where('idArt', $idArt)->get();
    }

    public static function findByOrderId($idOrder)
    {
    return self::where('idOrder', $idOrder)->get();
    }


}
