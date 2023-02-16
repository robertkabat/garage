<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TimeSlot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relationship with the booking model.
     *
     * @return HasOne
     */
    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class,'slot_id', 'id');
    }
}
