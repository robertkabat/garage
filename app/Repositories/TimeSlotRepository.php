<?php

namespace App\Repositories;

use App\Models\BlockedBookingDate;
use App\Models\Booking;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * @property Booking $model
 */
class TimeSlotRepository
{
    /**
     * @param string $model
     */
    public function __construct(private readonly string $model = TimeSlot::class)
    {
    }

    /**
     * Get all the bookings.
     *
     * @return mixed
     */
    public function getAvailableTimeSlots(string $date): Collection
    {
        // HELLOTEST: same thing could be done I think in a simpler way with just query builder but
        // I wanted to show alternative eloquent way

        $bookingsIdsForDate = Booking::where('booking_date', '=', $date)
            ->get()
            ->pluck('slot_id')
            ->toArray();

        // HELLOTEST: of course there can be more validation protecting endpoint from accepting blocked data but
        // I am restricting myself on purpose to just returning available options

        $blockedBookingsSlots = BlockedBookingDate::where('date', '=', $date)
            ->get()
            ->pluck('slot_ids')
            ->first();


        return $this->model::whereNotIn('id', $bookingsIdsForDate)
            ->whereNotIn('id', explode(',', $blockedBookingsSlots))
            ->get();
    }

    /**
     * Retrieve the timeslot by id.
     *
     * @param int $id
     * @return string
     */
    public function getTimeslotById(int $id): string
    {
        return $this->model::where('id', '=', $id)->first()->slot;
    }

    /**
     * Get all existing time slots.
     *
     * @return Collection
     */
    public function getAllTimeSlots(): Collection
    {
        return $this->model::all();
    }
}
