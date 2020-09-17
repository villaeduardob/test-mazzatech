<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Doctor;

use Validator;

class DoctorController extends Controller
{
    public $successStatus = 200;

    // login
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $doctor = Auth::doctor();
            $success['token'] =  $doctor->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);

        } else { return response()->json(['error' => 'Unauthorised'], 401); }
    }

    
    // list doctors' data
    public function list()
    {
        $doctor = Auth::doctor();
        return response()->json(['success' => $doctor], $this->successStatus);
    }
}
