<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'price', 'ad_limit', 'validity_minutes',
        'silver_price', 'gold_price', 'diamond_price'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function package()
{
    return $this->belongsTo(Package::class);
}
}