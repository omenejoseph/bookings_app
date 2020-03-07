<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Enums\StatusCodeEnum;
use App\Exceptions\NotFoundException;
use App\Facade\AppUtils;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use \Illuminate\Routing\Controller;

class UserController extends Controller
{
    private $user_contract;

    public function __construct(UserContract $user_contract)
    {
        $this->user_contract = $user_contract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->user_contract->create();
        return AppUtils::jsonResponse(StatusCodeEnum::CREATED, 'Created successfully', $user);
    }

    /**
     * Display the specified resource.
     * @throws NotFoundException
     * @param User $user;
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $this->user_contract->find($user);
        if (!$user){
            throw new NotFoundException("User not found");
        }
        return AppUtils::jsonResponse(StatusCodeEnum::OK, '', $user);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param User $user;
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user = $this->user_contract->update($user);
        return AppUtils::jsonResponse(StatusCodeEnum::UPDATED, 'Updated Successfully', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->user_contract->destroy($user);
        return AppUtils::jsonResponse(StatusCodeEnum::OK, 'Deleted Successfully');
    }

    public function list()
    {
        $users = $this->user_contract->list();
        return AppUtils::jsonResponse(StatusCodeEnum::OK, 'Action Successfully', $users);
    }
}
