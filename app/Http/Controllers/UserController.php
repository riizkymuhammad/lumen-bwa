<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $hashPassword = Hash::make($password);
        $user = User::create([
            'email' => $email,
            'password' => $hashPassword
        ]);

        return response()->json(['message' =>'Success'],201);
    }

    //
}
