<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'idMessage';

    protected $fillable = [
        'senderID',
        'message_content',
        'timestamps',
        'idUser',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
