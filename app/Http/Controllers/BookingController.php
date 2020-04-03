<?php

namespace App\Http\Controllers;

use App\Contracts\BookingContract;
use App\Enums\StatusCodeEnum;
use App\Facade\AppUtils;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * @var BookingContract
     */
    private $booking_contract;
    
    public function __construct(BookingContract $booking_contract)
    {
        $this->booking_contract = $booking_contract;
    }

    /**
     * @param CreateBookingRequest $request
     * @return mixed
     */
    public function create(CreateBookingRequest $request)
    {
        return AppUtils::jsonResponse(StatusCodeEnum::CREATED, 'Action Successful', $this->booking_contract->create());
    }

    /**
     * @param Booking $booking
     * @return mixed
     */
    public function find(Booking $booking)
    {
        dd("here");
        return AppUtils::jsonResponse(StatusCodeEnum::OK, 'Action Successful', $this->booking_contract->read($booking));
    }

    public function update(Booking $booking, UpdateBookingRequest $request)
    {
        return AppUtils::jsonResponse(StatusCodeEnum::UPDATED, 'Action Successful', $this->booking_contract->update($booking));
    }

    public function list()
    {
        return AppUtils::jsonResponse(StatusCodeEnum::OK, 'Action Successful', $this->booking_contract->list());
    }
}
