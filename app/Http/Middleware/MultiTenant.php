<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MultiTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if ($this->getAuthenticatedUser()) {

            $tenantId = $this->getAuthenticatedUser()->getData()->user->school_id;

            \Landlord::addTenant('school_id', $tenantId);
        }

        return $next($request);
    }

    public function getAuthenticatedUser()
    {
      	try {

            if (! $user = \JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

      	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      		  return response()->json(['token_expired'], $e->getStatusCode());
      	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      		  return response()->json(['token_invalid'], $e->getStatusCode());
      	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
      	}

      	// the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
