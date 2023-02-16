<?php

namespace App\Repositories;

use App\Models\BlockedBookingDate;
use App\Models\Booking;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Bool_;

/**
 * @property Booking $model
 */
class BookingRepository
{
    public function __construct(private readonly string $model = Booking::class)
    {
    }

    /**
     * Get all the bookings.
     *
     * @return mixed
     */
    public function all(): Collection
    {
        return $this->model::getQuery()->select(
            'bookings.id',
            'bookings.name',
            'bookings.email',
            'bookings.phone',
            'bookings.vehicle_make',
            'bookings.vehicle_model',
            'bookings.booking_date',
            'time_slots.slot'
        )
            ->join('time_slots', 'time_slots.id', '=', 'bookings.slot_id')
            ->get();
    }

    /**
     * Create a new booking.
     *
     * @param array $data
     * @return int
     */
    public function create(array $data): int|null
    {
        $timeSlot = TimeSlot::where('id', '=', $data['timeSlotId'])->first();
        $booking = new $this->model();
        $booking->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'vehicle_make' => $data['make'],
            'vehicle_model' => $data['model'],
            'booking_date' => Carbon::parse($data['date'])->toDateString(),
        ]);
        $timeSlot->booking()->save($booking);

        return $booking->id;
    }

    /**
     * Delete booking.
     *
     * @param int $bookingId
     * @return int
     */
    public function delete(int $bookingId): int
    {
        $this->model::where('id', '=', $bookingId)->delete();

        return $bookingId;
    }

    /**
     * Block booking.
     *
     * @param string $date
     * @param array $timeSlotIds
     * @return bool
     */
    public function blockBooking(string $date, array $timeSlotIds): Bool
    {
        $blockBookingDate = new BlockedBookingDate();
        $blockBookingDate->date = Carbon::parse($date)->toDateString();;
        if (!empty($timeSlotIds)) {
            $blockBookingDate->slot_ids = implode(',', $timeSlotIds);
        }

        $blockBookingDate->save();

        return true;
    }

    /**
     * Get all blocked days.
     *
     * @return Collection
     */
    public function getBlockedDays(): Collection
    {
        return BlockedBookingDate::whereNull('slot_ids')->get();
    }
}
