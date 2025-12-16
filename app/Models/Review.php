<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review'; 

    protected $primaryKey = 'idReview'; 


    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'idArtwork',
        'review_score',
        'review_comment',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'idArtwork', 'idArt');
    }
}
