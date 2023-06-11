<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'start_date',
        'end_date',
        'status',
        'amount',
        'nights',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class, 'user_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo( Room::class, 'room_id');
    }

}
