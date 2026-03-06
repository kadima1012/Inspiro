<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artist';

    protected $primaryKey = 'idArtist';

    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'artist_first_name',
        'artist_last_name',
        'artist_description',
        'artist_email',
        'artist_portofolio',
        'artist_experience',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return "{$this->artist_first_name} {$this->artist_last_name}";
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function artworks(): HasMany
    {
        return $this->hasMany(Artwork::class, 'idArtist', 'idArtist');
    }

    public function shopList(): HasMany
    {
        return $this->hasMany(ShopList::class, 'idArtist', 'idArtist');
    }

    public static function createForUser(User $user): self
    {
        return self::create([
            'idUser' => $user->idUser,
            'artist_first_name' => $user->user_first_name,
            'artist_last_name' => $user->user_last_name,
            'artist_description' => '',
            'artist_email' => $user->email,
            'artist_portofolio' => '',
            'artist_experience' => 0,
        ]);
    }

    public static function findIdByUserId(int $userId): ?int
    {
        $artist = self::where('idUser', $userId)->first();

        return $artist?->idArtist;
    }

    public static function updateArtist(int $idArtist, array $data): self
    {
        $artist = self::findOrFail($idArtist);
        $artist->update($data);

        return $artist;
    }

    public static function deleteByUserId(int $idUser): bool
    {
        $artist = self::where('idUser', $idUser)->firstOrFail();

        return $artist->delete();
    }
}
