<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'boat_id',
        'locale',
        'description',
        'base',
        'construction_type',
        'flat_board',
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }
}
