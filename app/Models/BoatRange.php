<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight'
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
