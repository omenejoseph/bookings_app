<?php

namespace App\Contracts;
use App\Repositories\BookingRepository;

/**
 * [interface description]
 * @var [type]
 * @see BookingRepository
 */
interface BookingContract
{
   public function create();
   public function read();
   public function update();
   public function destroy();
}