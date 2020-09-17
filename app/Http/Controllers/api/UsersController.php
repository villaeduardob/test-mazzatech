<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

use Validator;

class UsersController extends Controller
{
    public $successStatus = 200;

    // login
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            
            return response()->json(['success' => $success], $this->successStatus);

        } else { return response()->json(['error' => 'Unauthorised'], 401); }
    }

    
    // list users data
    public function list()
    {
        $user = Auth::user();
        
        return response()->json(['success' => $user], $this->successStatus);
    }
}
