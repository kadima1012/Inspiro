<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class OrderArtwork extends Model
{
    use HasFactory;

    protected $table = 'order_artwork';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'idArt',
        'idOrder',
        'quantity_to_order',
    ];

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class, 'idArt');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'idOrder');
    }

    public static function updateOrderArtwork(int $idArt, int $idOrder, int $quantity): ?self
    {
        $orderArtwork = self::where('idArt', $idArt)
            ->where('idOrder', $idOrder)
            ->first();

        if ($orderArtwork) {
            $orderArtwork->update([
                'quantity_to_order' => $orderArtwork->quantity_to_order + $quantity,
            ]);

            return $orderArtwork;
        }

        return null;
    }

    public static function findByArtId(int $idArt): Collection
    {
        return self::where('idArt', $idArt)->get();
    }

    public static function findByOrderId(int $idOrder): Collection
    {
        return self::where('idOrder', $idOrder)->get();
    }
}
