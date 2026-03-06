<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $table = 'convos';

    protected $primaryKey = 'Id_Conversation';

    protected $fillable = [
        'User1_Autorized',
        'User2_Autorized',
        'idUser',
        'idUser_1',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'idUser');
    }

    public function otherUser()
    {
        return $this->belongsTo(User::class, 'idUser_1', 'idUser');
    }

    public function messages()
    {
        return $this->belongsToMany(Msg::class, 'msg_convos', 'Id_Conversation', 'idMessage');
    }
}
