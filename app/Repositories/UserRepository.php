<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Exceptions\NotFoundException;
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
     * @param $user
     * @return mixed
     */
   public function find(User $user)
   {
       return $user;
   }

    /**
     * @return array
     */
   public function list() : array
   {
       $users = User::paginate(10)->toArray();
       $data = $users['data'];
       unset($users['data']);
       unset($users['items']);
       $meta = $users;
       return ['data' => $data, 'meta' => $meta];
   }

    /**
     * @param $user
     * @return User
     */
   public function update(User $user) : User
   {
       $user->update([
           'first_name' => request()->first_name  ??  $user->first_name,
           'last_name' =>  request()->last_name ??  $user->last_name,
           'title' => request()->title  ?? $user->title,
           'gender' =>  request()->gender?? $user->gender,
           'phone' =>  request()->phone ?? $user->phone,
           'role' =>  request()->role ?? $user->role,
       ]);
       return $user->refresh();
   }

    /**
     * @param User $user
     * @return bool
     * @throws \Exception
     */
   public function destroy(User $user) : bool
   {
       return $user->delete();
   }

    public function findUserByUserName()
    {
        $user =  User::whereEmail(request()->username)->orWhere('username', request()->username)->first();
        if (!$user){
            throw new NotFoundException("User with these credentials do not exist");
        }
        return $user;
    }
}