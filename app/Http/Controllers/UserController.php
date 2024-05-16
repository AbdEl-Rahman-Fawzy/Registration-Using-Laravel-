<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('registration_form');
    }
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation rules for incoming request data
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

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return validation error response
        if ($validator->fails()) {
            return $this->validationError(422, 'The given data was invalid.', $validator);
        }
        if ($request->password !== $request->pwd) {
            return response()->json(['success' => false, 'error' => ['message' => 'The password and confirmation password must match.']], 422);
        }
        try {
            // Create a new user record
            $user = User::create([
                'full_name' => $request->full_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password), // Use 'pwd' instead of 'password'
                'pwd' => Hash::make($request->pwd),
                'birthdate' => $request->birthdate,
                'image' => $request->image,
            ]);
    
            // Return success response with user data
            return response()->json(['success' => true, 'data' => $user], 200);
        } catch (\Exception $e) {
            // Log the exception details for debugging
            Log::error("Exception occurred during user registration: {$e->getMessage()} in {$e->getFile()} at line {$e->getLine()}\n{$e->getTraceAsString()}");
            
            // Return a generic error response
            return response()->json(['success' => false, 'error' => ['message' => 'Something went wrong. Please try again later.']], 500);
        }
        
        
    }


    /**
     * Format validation errors as JSON response.
     *
     * @param int $code
     * @param string $msg
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    private function validationError($code, $msg, $validator)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
            'errors' => $validator->errors(),
        ], $code);
    }
    
}
