<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlockedBookingDate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relationship with the TimeSlot model.
     *
     * @return HasMany
     */
    public function timeSlot(): HasMany
    {
        return $this->hasMany(TimeSlot::class);
    }
}
