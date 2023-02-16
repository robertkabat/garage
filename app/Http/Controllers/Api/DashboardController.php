<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BookingRepository;
use Illuminate\Http\JsonResponse;

class DashboardController extends ApiController
{
    /**
     * @param BookingRepository $bookingRepository
     */
    public function __construct(private readonly BookingRepository $bookingRepository)
    {
    }

    /**
     * Retrieve bookings.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'bookings' => $this->bookingRepository->all()
            ]
        ]);
    }
}
