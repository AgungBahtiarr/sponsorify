<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category', 'description'];

    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }
}
