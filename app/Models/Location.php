<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stop;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    // one2one with stops
    public function stop(): BelongsTo
    {
        return $this->BelongsTo(Stop::class);
    }
}
