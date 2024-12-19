<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register');
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,librarian',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika permintaan adalah API
        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data' => $user,
            'role' => $user->role,
            'token_type' => 'Bearer',
        ], 201);

        $user->sendEmailVerificationNotification();
    }


    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user->hasVerifiedEmail()) {
            // Kirimkan ulang email verifikasi jika belum diverifikasi
            $user->sendEmailVerificationNotification();

            return response()->json([
                'success' => false,
                'message' => 'Please verify your email before logging in. A new verification link has been sent.',
            ], 403);
        }

        // Jika user tidak ditemukan atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            // Untuk permintaan API
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials.',
                ], 401);
            }

            // Untuk permintaan browser
            return redirect()->back()->withErrors('Invalid credentials.');
        }

        $token = $user->createToken('authToken')->plainTextToken;

        // Tentukan pesan berdasarkan role user
        $roleMessage = '';
        if ($user->role === 'admin') {
            $roleMessage = 'Selamat datang, Admin!';
        } elseif ($user->role === 'librarian') {
            $roleMessage = 'Selamat datang, Librarian!';
        } else {
            $roleMessage = 'Selamat datang, User!';
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token_type' => 'Bearer',
            'user' => [
                'id_pengguna' => $user->id_pengguna,  // Assuming `id` is the correct column for user_id
                'name' => $user->name,
                'email' => $user->email,
                'role_message' => $roleMessage,  // Menambahkan pesan berdasarkan role
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,  // Assuming `updated_at` is the correct column for user_updated_at
                'token' => $token,
            ],
        ], 200);
    }

    // Logout User
    public function logout(Request $request)
    {
        // Revoke current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ]);
    }

    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => false,
                'message' => 'Email has already been verified.'
            ], 400);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));  // Menambahkan event Verified

        // Jika berhasil verifikasi email, tampilkan pesan sukses
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'success' => true,
                'message' => 'Email successfully verified.'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Email successfully verified.'
        ], 200);

        return response()->json([
            'success' => false,
            'message' => 'Invalid verification link.'
        ], 400);
    }
}