<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        // validators
        $rules = [
            'firstName' => 'required',
            'email' => 'unique:users|required',
            'password' => 'required'
        ];

        $input = $request->only('firstName', 'email', 'password');
        
        // verifying that the validations
        // they are correct
        $validator = Validator::make($input, $rules);

        // error in validators.
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }

        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $email = $request->email;
        $password = $request->password;

        // creating a new user.
        $user = User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        
        return response()->json(['success' => true]);
    }

}
