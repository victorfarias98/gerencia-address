<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        throw new HttpResponseException(response()->json([
            'error' => 'Unauthenticated'
        ], Response::HTTP_UNAUTHORIZED));
    }
}
