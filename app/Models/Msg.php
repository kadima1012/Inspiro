<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;

    protected $table = 'msg';

    protected $primaryKey = 'idMessage';

    protected $fillable = [
        'senderID',
        'message_content',
        'idUser',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderID', 'idUser');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function conversations()
    {
        return $this->belongsToMany(Discussion::class, 'msg_convos', 'idMessage', 'Id_Conversation');
    }
}
