<?php

/**
 * Created by PhpStorm.
 * User: ardani
 * Date: 8/4/17
 * Time: 11:18 AM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;

class AuthenticateController extends Controller
{
    private $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        

        if (!$user = Auth::attempt($credentials))
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $customClaims = [
            'role' => Auth::user()->roles()->first()->name, 
            'name' => Auth::user()->name, 
            'avatar' => Auth::user()->avatar
        ];

        try {
            // attempt to verify the credentials and create a token for the user
            $token = JWTAuth::fromUser(Auth::user(), $customClaims);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
