<?php

namespace App\Services;

use App\Mail\CustomerBookingConfirmation;
use App\Mail\GarageBookingConfirmation;
use App\Repositories\TimeSlotRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @param TimeSlotRepository $timeSlotRepository
     */
    public function __construct(private readonly TimeSlotRepository $timeSlotRepository)
    {
    }

    /**
     * Send confirmation emails out to the customer and the garage.
     *
     * @param string $customerEmail
     * @param string $date
     * @param int $timeSlotId
     * @return void
     */
    public function confirmBooking(string $customerEmail, string $date, int $timeSlotId): void
    {
        Mail::to($customerEmail)->send(new CustomerBookingConfirmation(
            Carbon::parse($date)->toDateString()
            . ' '
            .  $this->timeSlotRepository->getTimeslotById($timeSlotId)
        ));
        Mail::to(config('garage.management.hayden.email'))->send(new GarageBookingConfirmation());
    }
}
