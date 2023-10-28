<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';
    protected $fillable = [
        'proposal', 'id_sponsorship', 'id_event', 'id_status','id_users'
    ];
}
