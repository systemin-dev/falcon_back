<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'boat_id', 'boat_type', 'weight_range', 'mold_number', 'length_cm', 'shape'
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
