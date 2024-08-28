<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Travel;
use App\Models\Stop;

class days extends Model
{
    use HasFactory;

    protected $guarded = [];

    // one2many with travel: secondary
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    // one2many with stops: primary
    public function stops(): HasMany
    {
        return $this->hasMany(Stop::class);
    }
}
