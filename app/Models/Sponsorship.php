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
}
