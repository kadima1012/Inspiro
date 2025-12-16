<?php

namespace App\Models;

use App\Models\Artwork;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'idOrder';

    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'idArtist',
        'order_status',
        'order_details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public static function createFromShop($user, $artworkId)
    {
        return self::create([
            'idUser' => $user->idUser,
            'idArtist' => Artwork::where('idArt',$artworkId)->firstOrFail()->idArtist,
            'order_status' => 'Pending',
            'order_details' => 'Order placed successfully',
        ]);
    }

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class, 'order_artwork', 'idOrder', 'idArt');
    }

    public function total()
    {
        $total=0;
        foreach($this->artworks as $art){
            $total+=($art->shopItem()->item_price * $art->quantity_to_order);
        }
        return $total;
    }

    public static function cancelOrder($idOrder)
    {
        $order = self::find($idOrder);

        if ($order) {
            $order->order_status = 'Canceled by admin';
            $order->save();
            return true;
        }

        return false;
    }


}
