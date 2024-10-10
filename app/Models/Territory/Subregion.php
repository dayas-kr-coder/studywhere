<?php

namespace App\Models\Territory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subregion extends Model
{
    use HasFactory;

    // TODO: Fix this in the future
    protected $guarded = [];

    // Casts the JSON column to an array
    protected $casts = [
        'translations' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
