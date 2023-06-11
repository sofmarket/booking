<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'cin',
    ];

    public function getFullnameAttribute() {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    public function client(): HasMany
    {
        return $this->hasMany( Booking::class);
    }

}
