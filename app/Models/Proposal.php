<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals';
    protected $fillable = [
        'proposal',
        'id_sponsorship',
        'id_event',
        'id_status',
        'id_users',
        'message'
    ];


    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class, 'id_sponsorship');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
