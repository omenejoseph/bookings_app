<?php

namespace App\Contracts;
use App\Models\User;
use App\Repositories\UserRepository;

/**
 * [interface description]
 * @var [type]
 * @see UserRepository
 */
interface UserContract
{
   public function create();
   public function find(User $user);
   public function list();
   public function update(User $user);
   public function destroy(User $user);
   public function findUserByUserName();
}