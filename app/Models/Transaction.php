<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'id_event', 'id_sponsorship', 'id_proposal', 'sponsorship_funds'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }
    public function sponsorship()
    {
        return $this->belongsTo(Sponsorship::class, 'id_sponsorship');
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal');
    }
}
