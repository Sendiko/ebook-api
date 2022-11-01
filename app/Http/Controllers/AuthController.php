<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function me()
    {
        $biodata = array(
            "NIS" => 3103120150,
            "nama" => "Muhammad Rizky Sendiko",
            "phone" => 6282240626760,
            "class" => "XII RPL 5"
        );
        return json_encode($biodata);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator -> fails()){
            return response()->json([$validator->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 200,
            'message' => $user->name . ' berhasil register',
            'token' => $token,
            'token_type' => 'Bearer'
        ], 200);

    }

}
