<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Day;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels'; 

    protected $guarded = [];

    // one2many with user: secondary
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // one2many with days: primary
    public function days()
    {
        return $this->hasMany(Day::class, 'travel_id');
    }
}
