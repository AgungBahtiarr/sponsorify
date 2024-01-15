<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sponsorship extends Model
{
    use HasFactory;

    protected $table = 'sponsorships';

    protected $fillable = [
        'name',
        'email',
        'description',
        'profile_photo',
        'address',
        'id_category',
        'id_users'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'id_sponsorship');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class,'id_sponsorship');
    }

    protected static function booted()
    {
        static::deleting(function (Sponsorship $sponsorship) { // before delete() method call this
            $sponsorship->proposal()->delete();
        });
    }
}
