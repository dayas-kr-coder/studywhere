<?php

namespace App\Models\Territory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // TODO: Fix this in the future
    protected $guarded = [];

    // Casts the JSON column to an array
    protected $casts = [
        'translations' => 'array',
    ];

    public function subregions()
    {
        return $this->hasMany(Subregion::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
