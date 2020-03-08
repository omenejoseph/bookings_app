<?php


namespace App\Helpers;


use App\Enums\StatusCodeEnum;
use App\Exceptions\BadRequestException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AppUtils
{
    /**
     * @param int $code
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(int $code, string $message = '', $data = [])
    {
        $ok_status = [StatusCodeEnum::OK, StatusCodeEnum::CREATED, StatusCodeEnum::UPDATED];
        $status = (in_array($code, $ok_status)) ? 'true' : 'false';
        return response()->json(['status' => $status, 'data' => $data, 'message' => $message], $code);
    }

    /**
     * @param User $user
     * @return array
     * @throws BadRequestException
     */
    public function generateTokenDataFromUser(User $user) : array
    {
        $token =  auth()->guard('api')->tokenById($user->id);
        if (!$token){
            throw new BadRequestException("Token could not be generated, please try again");
        }
       return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'user' => $user
        ];
    }

    /**
     * @param $user
     * @throws BadRequestException
     * @return void
     */
    public function validateUsernameAndPassword(User $user) : void
    {
        $valid = Hash::check(request()->password, $user->password);
        if (!$valid){
            throw new BadRequestException("Username and Password does not match");
        }
    }

    /**
     * @param $faker
     * @return array
     */
    public function userFactoryData($faker)
    {
        return [
            'first_name' => $faker->name,
            'last_name' => $faker->name,
            'gender' => 'male',
            'title' => $faker->title,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'username' => $faker->userName,
            'role' => 'admin',
            'password' => 'password',
        ];
    }

    /**
     * @return array
     */
    public function generateTestTokenHeader()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        return ['Authorization' => "Bearer $token"];
    }
}