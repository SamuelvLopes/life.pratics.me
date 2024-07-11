<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="Paciente Authentication",
 *     description="API Endpoints of Paciente Authentication"
 * )
 */
class PacienteAuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/paciente/register",
     *     tags={"Paciente Authentication"},
     *     summary="Register a new paciente",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password"),
     *             @OA\Property(property="password_confirmation", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful registration"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pacientes',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $paciente = Paciente::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::guard('paciente')->login($paciente);

        return response()->json(compact('paciente', 'token'), 201);
    }

    /**
     * @OA\Post(
     *     path="/api/paciente/login",
     *     tags={"Paciente Authentication"},
     *     summary="Login a paciente",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('paciente')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('paciente')->factory()->getTTL() * 60
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/paciente/logout",
     *     tags={"Paciente Authentication"},
     *     summary="Logout a paciente",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout"
     *     )
     * )
     */
    public function logout()
    {
        Auth::guard('paciente')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Get(
     *     path="/api/paciente/me",
     *     tags={"Paciente Authentication"},
     *     summary="Get the authenticated paciente",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function me()
    {
        return response()->json(Auth::guard('paciente')->user());
    }
}
