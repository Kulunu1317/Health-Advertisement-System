<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeExtensionRequest extends Model
{
    protected $fillable = ['user_id', 'advertisement_id', 'extension_minutes', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}