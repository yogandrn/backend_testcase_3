<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6|max:100',
            'email' => 'required|string|min:8|max:100|email:dns|unique:users',
            'phone_number' => 'required|string|unique:users|regex:/^08[0-9]\d{9,15}$/',
            'password' => 'required|string|min:8|max:100|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]+$/',
        ],
        // customize pesan error
        [
            'phone_number.regex' => 'Phone number format is invalid!', 
            'password.regex' => 'Password must contain a combination of lowercase letters, uppercase letters, and numbers!',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['status' => 'Bad Request', 'message' => $validator->errors()->first()], 400); // return pesan error
        }
        
        // cek apakah ada seller dengan email atau nomor hp yang sama
        $checkSeller = Seller::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->count();
        
        // jika ada
        if ($checkSeller > 0) {
            return response()->json(['status' => 'Bad Request', 'message' => 'This email or phone number is registered as seller'], 400); // return pesan error
        }

        DB::beginTransaction();
        try {
            // insert data ke database
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            $user = User::where('email', $request->email)->first(); // ambil data user yang baru terdaftar

            $token = $user->createToken('authToken')->plainTextToken; // buat access token untuk user

            // return response berhasil dan data user
            return response()->json([
                'status' => 'Success', 
                'message' => 'Successfully registered.', 
                'data' => [
                    'token_type' => 'Bearer',
                    'access_token' => $token,
                    'user' => $user,
                    ] 
                ], 200); 

        } catch (\Exception $error) {
            DB::rollBack();
            return response()->json(['status' => 'Error', 'message' => $error->getMessage()], 500); // tampil pesan error
        }
    }

    public function login(Request $request) 
    {
        try {
            // validasi input
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|min:8|max:100|email:dns',
                'password' => 'required|string|min:8|max:100',
            ]);

            // jika validasi gagal
            if ($validator->fails()) {
                return response()->json(['status' => 'Bad Request', 'message' => $validator->errors()->first()], 400); // return pesan error
            }
            
            // cek apakah email sudah terdaftar
            $checkUser = User::where('email', $request->email)->count();
            
            // jika belum ada
            if ($checkUser < 1) {
                return response()->json(['status' => 'Bad Request', 'message' => 'Email address is not found!'], 404); // return pesan error
            }
            
            $user = User::where('email', $request->email)->first(); // ambil data user
            
            // jika password salah
            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['status' => 'Unauthenticated', 'message' => 'Invalid credentials!'], 401); // return pesan error
            }

            $token = $user->createToken('authToken')->plainTextToken; // buat access token untuk user

            // return response berhasil dan data user
            return response()->json([
                'status' => 'Success', 
                'message' => 'Authenticated', 
                'data' => [
                    'token_type' => 'Bearer',
                    'access_token' => $token,
                    'user' => $user,
                    ] 
                ], 200); 

        } catch (\Exception $error) {
            return response()->json(['status' => 'Error', 'message' => $error->getMessage()], 500); // tampil pesan error
        }
    }

    public function logout(Request $request) 
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['status' => 'Success', 'message' => 'Token revoked'], 200);
        } catch (Exception $error) {
            return response()->json(['status' => 'Error', 'message' => $error->getMessage()], 500);
        }
    }
}
