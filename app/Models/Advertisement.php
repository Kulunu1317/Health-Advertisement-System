<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id', 'purchase_id', 'medicine_name', 'medicine_type',
        'company_logo', 'location', 'description', 'is_approved', 'expires_at'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}