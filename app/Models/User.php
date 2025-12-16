<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;




class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idUser';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_first_name',
        'user_last_name',
        'user_username',
        'email',
        'user_status',
        'user_birthdate',
        'password',
        'user_became_artist',
        'user_became_artist_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'idUser', 'idUser');
    }

    public function isArtist(){
        if(Artist::where('idUser', $this->idUser)->firstOrFail()){
            return true;
        } else {
            return false;
        }
    }

    public function getStoredRole()
    {
        return $this->roles()->first();
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = \Spatie\Permission\Models\Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->sync([$role->id]);

        return $this;
    }
}
