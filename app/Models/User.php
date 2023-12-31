<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'id_role'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function sponsorship()
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'id_users');
    }
    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'id_users');
    }


    protected static function booted()
    {
        static::deleting(function (User $user) { // before delete() method call this
            $user->proposal()->delete();
            if ($user->id_role == 1) {
                $user->event()->delete();
            } else {
                $user->sponsorship()->delete();
            }

        });
    }
}
