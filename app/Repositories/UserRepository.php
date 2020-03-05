<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserContract
{
    /**
     * @param $data
     * @return mixed
     */
   public function create() : User
   {
        return User::firstOrCreate([
           'first_name' => request()->first_name,
           'last_name' => request()->last_name,
           'title' => request()->title,
           'gender' => request()->gender,
           'phone' => request()->phone,
           'email' => request()->email,
           'username' => request()->username,
           'role' => request()->role,
           'password' => Hash::make(request()->password)
        ]);
   }

    /**
     * @return mixed
     */
   public function find()
   {
       return User::find(request()->id);
   }

    /**
     * @return Collection
     */
   public function list() : Collection
   {
       return User::all();
   }

    /**
     * @return User
     */
   public function update() : User
   {
       $user = $this->find();
       $user->update([
           'first_name' => $user->first_name ?? request()->first_name ,
           'last_name' => $user->last_name ?? request()->last_name,
           'title' => $user->title ?? request()->title,
           'gender' => $user->gender ?? request()->gender,
           'phone' => $user->phone ?? request()->phone,
           'email' => $user->email ?? request()->email,
           'username' => $user->username ?? request()->username,
           'role' => $user->role ?? request()->role,
       ]);
       return $user->refresh();
   }

    /**
     * @return bool
     */
   public function destroy() : bool
   {
       return $this->find()->destroy();
   }
}