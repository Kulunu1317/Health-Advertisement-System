<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenewalRequest extends Model
{
    protected $fillable = ['user_id', 'purchase_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}