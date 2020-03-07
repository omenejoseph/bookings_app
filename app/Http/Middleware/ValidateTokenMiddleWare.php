<?php

namespace App\Http\Middleware;

use App\Enums\StatusCodeEnum;
use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValidateTokenMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws BadRequestException
     * @throws NotFoundException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            // if user is null then token wasn't resolved to an employee so it is invalid
            if(!$user)
                throw new NotFoundException("User not found");

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                throw new BadRequestException("Token is invalid", StatusCodeEnum::UNAUTHORISED);
            } else {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    throw new BadRequestException("Token is Expired", StatusCodeEnum::UNAUTHORISED);
                } else {
                    // no token was sent
                    throw new NotFoundException("Token not sent");
                }
            }
        }
        // attach employee payload to request to prevent another database call to fetch employee owning the request
        $request->merge([
            'user' => $user
        ]);
        return $next($request);
    }
}
