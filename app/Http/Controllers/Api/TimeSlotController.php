<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AvailableTimeSlots;
use App\Http\Requests\CreateBooking;
use App\Http\Requests\DeleteBooking;
use App\Repositories\BookingRepository;
use App\Repositories\TimeSlotRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TimeSlotController extends ApiController
{
    /**
     * @param TimeSlotRepository $timeSlotRepository
     */
    public function __construct(private readonly TimeSlotRepository $timeSlotRepository)
    {

    }

    /**
     * Get all the available time slots.
     *
     * @param AvailableTimeSlots $request
     * @return JsonResponse
     */
    public function index(AvailableTimeSlots $request): JsonResponse
    {
        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'timeSlots' => $this->timeSlotRepository
                    ->getAvailableTimeSlots(Carbon::parse($request->date)
                        ->toDateString())
            ]
        ]);
    }

    /**
     * Get all time slots.
     *
     * @return JsonResponse
     */
    public function getAllTimeSlots(): JsonResponse
    {
        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'timeSlots' => $this->timeSlotRepository->getAllTimeSlots()
            ]
        ]);
    }
}
