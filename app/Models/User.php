<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'idUser';

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'idUser', 'idUser');
    }

    public function artist(): HasOne
    {
        return $this->hasOne(Artist::class, 'idUser', 'idUser');
    }

    public function lives(): HasMany
    {
        return $this->hasMany(Lives::class, 'idUser', 'idUser');
    }

    public function isArtist(): bool
    {
        return Artist::where('idUser', $this->idUser)->exists();
    }

    public function getStoredRole(): ?\Spatie\Permission\Models\Role
    {
        return $this->roles()->first();
    }

    public function assignRole(...$roles): self
    {
        $role = $roles[0] ?? null;

        if (is_string($role)) {
            $role = \Spatie\Permission\Models\Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->sync([$role->id]);

        return $this;
    }
}
