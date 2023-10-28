<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;
    protected $table = 'saveds';

    protected $fillable = [
        'id_event',
        'id_sponsorship',
        'id_users'
    ];
}
