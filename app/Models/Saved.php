<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;
    protected $table = 'saveds';

    protected $fillable = [
        'id_sponsorship',
        'id_users'
    ];

    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class, 'id_sponsorship');
    }
}
