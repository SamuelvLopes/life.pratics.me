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

    public function login(Request $request)
    {
        $credentials = $request->only('med_email', 'med_password');

        if (! $token = Auth::guard('medico')->attempt(['med_email' => $credentials['med_email'], 'password' => $credentials['med_password']])) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        Auth::guard('medico')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
    }

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
