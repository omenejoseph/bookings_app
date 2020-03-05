<?php

namespace App\Contracts;
use App\Repositories\UserRepository;

/**
 * [interface description]
 * @var [type]
 * @see UserRepository
 */
interface UserContract
{
   public function create();
   public function find();
   public function list();
   public function update();
   public function destroy();
}