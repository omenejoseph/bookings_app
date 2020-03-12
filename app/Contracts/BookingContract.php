<?php

namespace App\Contracts;
use App\Models\Booking;
use App\Repositories\BookingRepository;

/**
 * [interface description]
 * @var [type]
 * @see BookingRepository
 */
interface BookingContract
{
   public function create();
   public function read(Booking $booking);
   public function update(Booking $booking);
   public function destroy(Booking $booking);
   public function list();
}