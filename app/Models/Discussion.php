<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_Discussion';

    protected $fillable = [
        'User1_Autorized',
        'User2_Autorized',
        'idUser',
        'idUser_1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'idUser_1');
    }
}
