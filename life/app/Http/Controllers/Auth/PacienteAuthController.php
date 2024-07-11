<?php

namespace App\Http\Controllers\Auth;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PacienteAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pac_nome' => 'required|string|max:255',
            'pac_data_nascimento' => 'required|date',
            'pac_email' => 'required|string|email|max:255|unique:paciente,pac_email',
            'pac_password' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $paciente = Paciente::create([
            'pac_nome' => $request->pac_nome,
            'pac_data_nascimento' => $request->pac_data_nascimento,
            'pac_email' => $request->pac_email,
            'pac_password' => Hash::make($request->pac_password),
        ]);

        return response()->json([
            'message' => 'Paciente registrado com sucesso!',
            'paciente' => $paciente
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('pac_email', 'pac_password');

        if (! $token = Auth::guard('paciente')->attempt(['pac_email' => $credentials['pac_email'], 'password' => $credentials['pac_password']])) {
            return response()->json(['error' => 'Não autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        Auth::guard('paciente')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso!'], 200);
    }

    public function me(Request $request)
    {
        return response()->json(Auth::guard('paciente')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('paciente')->factory()->getTTL() * 60
        ]);
    }
}
