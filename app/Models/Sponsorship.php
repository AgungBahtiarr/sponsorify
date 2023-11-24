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

    // public function saved()
    // {
    //     return $this->hasMany(Saved::class, 'id_');
    // }
}
