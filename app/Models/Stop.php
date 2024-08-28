<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Day;
use App\Models\Stop_image;
use App\Models\Location;

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

    // one2one with locations
    public function location(): hasOne
    {
        return $this->hasOne(Location::class);
    }
}
