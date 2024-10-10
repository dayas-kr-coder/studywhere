<?php

namespace App\Models\Territory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // TODO: Fix this in the future
    protected $guarded = [];

    // Casts the JSON column to an array
    protected $casts = [
        'translations' => 'array',
        'timezones' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function subregion()
    {
        return $this->belongsTo(Subregion::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
