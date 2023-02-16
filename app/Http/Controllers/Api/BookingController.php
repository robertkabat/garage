<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BlockBooking;
use App\Http\Requests\CreateBooking;
use App\Http\Requests\DeleteBooking;
use App\Repositories\BookingRepository;
use App\Services\EmailService;
use App\Services\LoggerService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingController extends ApiController
{
    /**
     * @param BookingRepository $bookingRepository
     * @param EmailService $emailService
     * @param LoggerService $loggerService
     */
    public function __construct(
        private readonly BookingRepository $bookingRepository,
        private readonly EmailService $emailService,
        private readonly LoggerService $loggerService
    ) {
    }

    /**
     * Index all the visits.
     *
     * @param CreateBooking $request
     * @return JsonResponse
     */
    public function create(CreateBooking $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $bookingId = $this->bookingRepository->create($request->only([
                'name',
                'email',
                'phone',
                'make',
                'model',
                'date',
                'timeSlotId',
            ]));
            DB::commit();
            $this->emailService->confirmBooking($request->email, $request->date, $request->timeSlotId);
        } catch (Exception $exception) {
            // HELLOTEST: here we could have something interesting like to handle the problem, but I'll go with logs
            $this->loggerService->log();
            DB::rollBack();
            return $this->badRequestResponse(['message' => 'Problem with creating the booking']);
        }

        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'bookingId' => $bookingId
            ]
        ]);
    }

    public function delete(DeleteBooking $request)
    {
        DB::beginTransaction();
        try {
            $this->bookingRepository->delete($request->bookingId);
            DB::commit();
        } catch (Exception $exception) {
            // HELLOTEST: here we could have something interesting like to handle the problem, but I'll go with logs
            $this->loggerService->log();
            DB::rollBack();
            return $this->badRequestResponse(['message' => 'Problem with deleting the booking']);
        }

        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'bookingId' => $request->bookingId
            ]
        ]);
    }

    /**
     * Block booking within given time frame.
     *
     * @param BlockBooking $request
     * @return JsonResponse
     */
    public function blockBooking(BlockBooking $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->bookingRepository->blockBooking($request->date, $request->timeSlotIds);
            DB::commit();
        } catch (Exception $exception) {
            $this->loggerService->log();
            DB::rollBack();
        }

        return $this->okResponse();
    }

    /**
     * Retrieve blocked days.
     *
     * @return JsonResponse
     */
    public function getBlockedDays(): JsonResponse
    {
        return $this->okResponse([
            'message' => 'OK',
            'data' => [
                'blockedDays' => $this->bookingRepository->getBlockedDays()
            ]
        ]);
    }
}
