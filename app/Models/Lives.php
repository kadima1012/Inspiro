<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lives extends Model
{
    use HasFactory;

    protected $table = 'lives'; 

    public $timestamps = false;

    protected $fillable = [
        'idUser',
        'idCity',
    ];

    protected $primaryKey = ['idUser', 'idCity'];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'idCity', 'idCity');
    }
}
