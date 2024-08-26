<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travels extends Model
{
    use HasFactory;

    // one2many rel with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
