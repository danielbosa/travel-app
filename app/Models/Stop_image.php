<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop_image extends Model
{
    use HasFactory;

    protected $guarded = [];

    // one2many with day: secondary
    public function stop(): BelongsTo
    {
        return $this->belongsTo(Stop::class);
    }
}
