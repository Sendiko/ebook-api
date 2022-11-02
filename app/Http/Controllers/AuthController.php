<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        $validator = $request->validate([ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 200,
            'message' => $user->name . ' berhasil register',
            'token' => $token,
            'token_type' => 'Bearer'
        ], 200);

    }

    public function login(Request $request){
        $validator = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validator['email'])->firstOrFail();
        if(!$user || !Hash::check($validator['password'], $user->password)){
            return response()->json([
                'status' => 401,
                'message' => $user->name . ' gagal login, mohon cek kembali data',
                'token' => 'null',
                'token_type' => 'null'
            ], 401);
        } else {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'message' => $user->name . ' berhasil register',
                'token' => $token,
                'token_type' => 'Bearer'
            ], 200);
        }

    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'berhasil logout',
            'token' => 'null',
            'token_type' => 'null'
        ], 200);
    }

}
