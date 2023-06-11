<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{

    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'address',
        'city',
    ];

    protected static function booted()
    {
        static::created(function (Hotel $hotel) {
            $hotel->image = $hotel->id . '.jpg';
            $hotel->saveQuietly();
        });
    }

    public function getImageAttribute ()
    {
        return 'http://localhost:8000/images/hotels/' . $this->attributes['image'];
    }

    public function rooms(): HasMany
    {
        return $this->hasMany( Room::class);
    }

}
