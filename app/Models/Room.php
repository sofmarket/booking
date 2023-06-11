<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $with = [ 'hotel' ];

    protected $fillable = [
        'hotel_id',
        'image',
        'name',
        'floor',
        'type',
        'beds',
        'price',
    ];

    protected static function booted()
    {
        static::created(function (Room $room) {
            $room->image = $room->id . '.jpg';
            $room->saveQuietly();
        });
    }

    public function getImageAttribute ()
    {
        return 'http://localhost:8000/images/rooms/' . $this->attributes['image'];
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo( Hotel::class, 'hotel_id');
    }

}
