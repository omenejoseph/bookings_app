<?php

namespace App\Repositories;

use App\Contracts\BookingContract;
use App\Models\Booking;

class BookingRepository implements BookingContract
{
   public function create()
   {
        return Booking::firstOrCreate([
            'title' => request()->title
        ]);
   }
   public function read(Booking $booking)
   {
        return $booking;
   }
   public function update(Booking $booking)
   {

   }
   public function destroy(Booking $booking)
   {

   }

    public function list()
    {
        return Booking::all();
    }
}