<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'idOrder';

    public $timestamps = false;

    public const STATUS_IN_CART = 'in cart';
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_SENT = 'Sent';
    public const STATUS_RECEIVED = 'Received';
    public const STATUS_CANCELED = 'Canceled by admin';

    protected $fillable = [
        'idUser',
        'idArtist',
        'order_status',
        'order_details',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function artworks(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'order_artwork', 'idOrder', 'idArt')
            ->withPivot('quantity_to_order');
    }

    public function total(): float
    {
        $total = 0;

        foreach ($this->artworks as $art) {
            $shopItem = $art->shopList()->first();

            if ($shopItem) {
                $total += $shopItem->item_price * $art->pivot->quantity_to_order;
            }
        }

        return $total;
    }

    public static function createFromShop(User $user, int $artworkId): self
    {
        return self::create([
            'idUser' => $user->idUser,
            'idArtist' => Artwork::where('idArt', $artworkId)->firstOrFail()->idArtist,
            'order_status' => self::STATUS_ACTIVE,
            'order_details' => 'Order placed successfully',
        ]);
    }

    public static function cancelOrder(int $idOrder): bool
    {
        $order = self::find($idOrder);

        if ($order) {
            $order->order_status = self::STATUS_CANCELED;
            $order->save();

            return true;
        }

        return false;
    }
}
