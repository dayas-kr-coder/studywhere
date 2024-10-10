<?php

namespace App\Models\Territory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // TODO: Fix this in the future
    protected $guarded = [];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
