<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="Admin Authentication",
 *     description="API Endpoints of Admin Authentication"
 * )
 */
class AdminAuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/admin/register",
     *     tags={"Admin Authentication"},
     *     summary="Register a new admin user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="password_confirmation", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Admin user registered successfully"),
     *     @OA\Response(response=400, description="Validation error")
     * )
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('admin')->login($user);

        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * @OA\Post(
     *     path="/admin/login",
     *     tags={"Admin Authentication"},
     *     summary="Login as an admin user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successfully logged in"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     path="/admin/logout",
     *     tags={"Admin Authentication"},
     *     summary="Logout the admin user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successfully logged out")
     * )
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Get(
     *     path="/admin/me",
     *     tags={"Admin Authentication"},
     *     summary="Get the authenticated admin user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Authenticated admin user")
     * )
     */
    public function me()
    {
        return response()->json(Auth::guard('admin')->user());
    }

    /**
     * Respond with token
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('admin')->factory()->getTTL() * 60
        ]);
    }
}
