<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;

class Stop extends Model
{
    use HasFactory;

    protected $guarded = [];

    // one2many with day: secondary
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

    // one2many with stops: primary
    public function stop_images(): HasMany
    {
        return $this->hasMany(Stop_images::class);
    }
}
