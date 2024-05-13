<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UserController extends Controller
{
 public function store(request $request){
    $rules = [
        'full_name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255',
        'birthdate' => 'required|date',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:8',
        'pwd' => 'required|string|same:password',
        'email' => 'required|string|email|max:255|unique:users',
        'image' => 'required|max:2048',
    ];

    $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return $this->validationError(422, 'The given data was invalid.', $validator);
        }
        // Download and save the image temporarily

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('images');
        }


    try{
        $user = User::firstOrCreate(
            [
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pwd' => $request->pwd,
                'password'=>Hash::make($request->password),
                'birthdate'=>$request->birthdate,
                'image' => $request->image,

            ],
        );



    }catch (\Exception $e) {
        // Handle the exception if something goes wrong
        return response()->json(['success' => false, 'error' => ['message' => 'Something went wrong. Please try again later.']]);
    }
    return response()->json(['success' => true, 'data' => $user]);


 }


        public function validationError($code, $msg, $validator)
        {
            return response()->json([
            'success' => false,
            'message' => $msg,
            'errors' => $validator->errors(),
            ],
            $code);
        }

        public function error500()
        {
            return response()->json([
            'success' => false,
            'error' => [
                'message' => 'something went wrong, Please try again later',
            ],
            ], 500);
        }

        public function data($data, $message = null)
        {
          return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
          ]);
        }
}
