<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthLoginRequest;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * Register a new user and give a new token.
     *
     * @param  App\Http\Requests\Auth\AuthRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $request){
        
        try {
            $user = User::Create($request->validated());
            
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse(['access_token' => $token]);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * Authenticate a user, give a new token and delete his old tokens.
     *
     * @param  App\Http\Requests\Auth\AuthRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request){

        try {
            if(!Auth::attempt($request->validated()) ){
                return $this->errorResponse('Invalid Credentials',Response::HTTP_UNAUTHORIZED);
            }
    
            $user = User::Where('email',$request['email'])->firstOrFail();
    
            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;
    
            return $this->successResponse(['access_token' => $token]);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
