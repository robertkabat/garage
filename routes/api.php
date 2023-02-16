<?php

use App\Http\Controllers\Api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\TimeSlotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/***********************************************************************************************************************
 *
 * GENERIC USER ENDPOINTS
 *
 ***********************************************************************************************************************/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/***********************************************************************************************************************
*
* STAFF ADMIN AREA
*
***********************************************************************************************************************/

Route::middleware([
    'auth:sanctum',
    'verified'
])->group(function () {
    Route::delete('/account/bookings/{bookingId}', [BookingController::class, 'delete'])->name('account.bookings.delete');
    Route::get('/account/dashboard', [DashboardController::class, 'index'])->name('account.dashboard.index');
    Route::get('/account/time-slots', [TimeSlotController::class, 'getAllTimeSlots'])->name('account.time-slots.all');
    Route::post('/account/block-booking', [BookingController::class, 'blockBooking'])->name('account.booking.block');
});

/***********************************************************************************************************************
 *
 * PUBLIC CLIENT ROUTES
 *
 ***********************************************************************************************************************/

Route::post('/booking', [BookingController::class, 'create'])->name('public.bookings.create');
Route::get('/available-time-slots', [TimeSlotController::class, 'index'])->name('public.time-slots.get');
Route::get('/blocked-days', [BookingController::class, 'getBlockedDays'])->name('account.booking.blocked-days');
