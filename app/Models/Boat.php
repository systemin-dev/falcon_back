<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    const CATEGORIES = [
        '1' => 'Skiff',
        '2' => 'Double et Deux sans barreur',
        '4' => 'Quatre',
        '8' => 'Huit',
        'c1' => 'Coastal 1',
        'c2' => 'Coastal 2',
        'c4' => 'Coastal 4',
        'g1' => 'Gig 1',
        'g2' => 'Gig 2',
        'g4' => 'Gig 4',
        'other' => 'Autre'
    ];

    const CONDITIONS = [
        'new' => 'Neuf',
        'used' => 'Utilisé',
        'needs repair' => 'À réparer'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'image',
        'condition',
    ];

    public function getImageAttribute($value)
    {
        if (!$value) {
            return "import/assets/falcon.jpg";
        }

        return $value;
    }

    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }

    public function boatRanges()
    {
        return $this->hasMany(BoatRange::class);
    }

    public function translations()
    {
        return $this->hasMany(BoatTranslation::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($boat) {
            $boat->dimensions()->delete();
            $boat->translations()->delete();
        });
    }

    public static function getCategoryLabel($category)
    {
        return self::CATEGORIES[$category] ?? $category;
    }

    public static function getConditionLabel($condition)
    {
        return self::CONDITIONS[$condition] ?? $condition;
    }

    public function getTranslation($locale)
    {
        return $this->translations()->where('locale', $locale)->first();
    }
}
