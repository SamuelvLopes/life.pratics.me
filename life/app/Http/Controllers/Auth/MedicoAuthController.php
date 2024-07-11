<?php

namespace App\Http\Controllers\Auth;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class MedicoAuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/medico/register",
     *     tags={"Admin"},
     *     summary="Register a new medico",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"med_crm", "med_nome", "med_email", "med_password"},
     *             @OA\Property(property="med_crm", type="string", example="123456"),
     *             @OA\Property(property="med_nome", type="string", example="Dr. João"),
     *             @OA\Property(property="med_email", type="string", format="email", example="dr.joao@example.com"),
     *             @OA\Property(property="med_password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Médico registrado com sucesso"),
     *     @OA\Response(response=400, description="Erro de validação")
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'med_crm' => 'required|string|max:255|unique:medico,med_crm',
            'med_nome' => 'required|string|max:255',
            'med_email' => 'required|string|email|max:255|unique:medico,med_email',
            'med_password' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $medico = Medico::create([
            'med_crm' => $request->med_crm,
            'med_nome' => $request->med_nome,
            'med_email' => $request->med_email,
            'med_password' => Hash::make($request->med_password),
        ]);

        return response()->json([
            'message' => 'Médico registrado com sucesso!',
            'medico' => $medico
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/medico/login",
     *     tags={"Medico"},
     *     summary="Login for medico",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"med_email", "med_password"},
     *             @OA\Property(property="med_email", type="string", format="email", example="dr.joao@example.com"),
     *             @OA\Property(property="med_password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful login"),
     *     @OA\Response(response=401, description="Não autorizado")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('med_email', 'med_password');

        if (! $token = Auth::guard('medico')->attempt(['med_email' => $credentials['med_email'], 'password' => $credentials['med_password']])) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     path="/medico/logout",
     *     tags={"Medico"},
     *     summary="Logout for medico",
     *     @OA\Response(response=200, description="Logout realizado com sucesso"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function logout(Request $request)
    {
        Auth::guard('medico')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
    }

    /**
     * @OA\Get(
     *     path="/medico/me",
     *     tags={"Medico"},
     *     summary="Get medico details",
     *     @OA\Response(response=200, description="Medico details"),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function me(Request $request)
    {
        return response()->json(Auth::guard('medico')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('medico')->factory()->getTTL() * 60
        ]);
    }
}
