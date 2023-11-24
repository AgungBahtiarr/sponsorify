<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $fillable = ['name', 'description', 'profile_photo', 'email', 'id_users'];


    public function users()
    {
        return $this->belongsTo(User::class,'id_users');
    }
}
