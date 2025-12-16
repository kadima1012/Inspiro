<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'artist_experience'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public static function createForUser($user)
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

    public static function deleteById($id)
    {
        $artist = self::findOrFail($id);

        $artist->artworks()->delete();

        return $artist->delete();
    }

    public static function deleteByUserId($idUser)
    {
        $artist = self::where('idUser', $idUser)->firstOrFail();
    
        return $artist->delete();
    }
    

    public static function findIdByUserId($userId)
    {
        $artist = self::where('idUser', $userId)->first();
        return $artist ? $artist->idArtist : null;
    }

    public static function updateArtist($idArtist, $data)
    {
        $artist = self::findOrFail($idArtist);
        $artist->update($data);
        return $artist;
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'idArtist', 'idArtist');
    }

    public function shopList()
    {
        return $this->hasMany(ShopList::class, 'idArtist', 'idArtist');
    }




}
