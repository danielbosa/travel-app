<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class days extends Model
{
    use HasFactory;

    protected $guarded = [];

    // one2many with travel: secondary
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }
}
