<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city'; 

    protected $primaryKey = 'idCity'; 

    public $timestamps = false;

    protected $fillable = [
        'city_name',
        'idCountry',
        'city_PC',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'idCountry', 'idCountry');
    }

}
