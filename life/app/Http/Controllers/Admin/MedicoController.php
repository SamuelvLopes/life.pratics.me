<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medico;
use App\Models\Consulta;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/medico",
     *     tags={"Admin"},
     *     summary="Lista todos os médicos",
     *     @OA\Response(response=200, description="Lista de médicos")
     * )
     */
    public function index()
    {
        $medicos = Medico::all();
        return response()->json($medicos);
    }

    /**
     * @OA\Post(
     *     path="/medico",
     *     tags={"Admin"},
     *     summary="Cria um novo médico",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="med_crm", type="string"),
     *             @OA\Property(property="med_nome", type="string"),
     *             @OA\Property(property="med_email", type="string"),
     *             @OA\Property(property="med_password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Médico criado com sucesso"),
     *     @OA\Response(response=400, description="Erro de validação")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'med_crm' => 'required|string|max:255|unique:medico,med_crm',
            'med_nome' => 'required|string|max:255',
            'med_email' => 'required|string|email|max:255|unique:medico,med_email',
            'med_password' => 'required|string|min:8|max:255',
        ]);

        $medico = Medico::create([
            'med_crm' => $request->med_crm,
            'med_nome' => $request->med_nome,
            'med_email' => $request->med_email,
            'med_password' => $request->med_password,
        ]);

        return response()->json([
            'message' => 'Médico criado com sucesso!',
            'medico' => $medico
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/medico/{id}",
     *     tags={"Admin"},
     *     summary="Exibe um médico específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detalhes do médico"),
     *     @OA\Response(response=404, description="Médico não encontrado")
     * )
     */
    public function show($id)
    {
        $medico = Medico::findOrFail($id);
        return response()->json($medico);
    }

    /**
     * @OA\Put(
     *     path="/medico/{id}",
     *     tags={"Admin"},
     *     summary="Atualiza um médico existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="med_crm", type="string"),
     *             @OA\Property(property="med_nome", type="string"),
     *             @OA\Property(property="med_email", type="string"),
     *             @OA\Property(property="med_password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Médico atualizado com sucesso"),
     *     @OA\Response(response=404, description="Médico não encontrado")
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'med_crm' => 'required|string|max:255|unique:medico,med_crm,' . $id . ',med_codigo',
            'med_nome' => 'required|string|max:255',
            'med_email' => 'required|string|email|max:255|unique:medico,med_email,' . $id . ',med_codigo',
            'med_password' => 'nullable|string|min:8|max:255',
        ]);

        $medico = Medico::findOrFail($id);

        $data = $request->all();
        if ($request->filled('med_password')) {
            $data['med_password'] = bcrypt($request->med_password);
        } else {
            unset($data['med_password']);
        }

        $medico->update($data);

        return response()->json([
            'message' => 'Médico atualizado com sucesso!',
            'medico' => $medico
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/medico/{id}",
     *     tags={"Admin"},
     *     summary="Remove um médico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Médico removido com sucesso"),
     *     @OA\Response(response=404, description="Médico não encontrado")
     * )
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json([
            'message' => 'Médico removido com sucesso!'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/medico/consultas",
     *     tags={"Medico"},
     *     summary="Lista as consultas do médico autenticado",
     *     @OA\Response(response=200, description="Lista de consultas")
     * )
     */
    public function listConsultas()
    {
        $medico = auth()->user();
        $consultas = Consulta::where('med_codigo', $medico->med_codigo)->get();
        return response()->json($consultas);
    }

    /**
     * @OA\Get(
     *     path="/medico/consultas/{consulta_id}",
     *     tags={"Medico"},
     *     summary="Exibe uma consulta específica do médico autenticado",
     *     @OA\Parameter(
     *         name="consulta_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detalhes da consulta"),
     *     @OA\Response(response=404, description="Consulta não encontrada")
     * )
     */
    public function showConsulta($consulta_id)
    {
        $medico = auth()->user();
        $consulta = Consulta::where('med_codigo', $medico->med_codigo)->where('cons_codigo', $consulta_id)->firstOrFail();
        return response()->json($consulta);
    }

    /**
     * @OA\Get(
     *     path="/medico/pacientes",
     *     tags={"Medico"},
     *     summary="Lista os pacientes do médico autenticado",
     *     @OA\Response(response=200, description="Lista de pacientes")
     * )
     */
    public function listPacientes()
    {
        $medico = auth()->user();
        $consultas = Consulta::where('med_codigo', $medico->med_codigo)->pluck('pac_codigo');
        $pacientes = Paciente::whereIn('pac_codigo', $consultas)->get();
        return response()->json($pacientes);
    }

    /**
     * @OA\Get(
     *     path="/medico/pacientes/{paciente_id}",
     *     tags={"Medico"},
     *     summary="Exibe um paciente específico do médico autenticado",
     *     @OA\Parameter(
     *         name="paciente_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detalhes do paciente"),
     *     @OA\Response(response=404, description="Paciente não encontrado")
     * )
     */
    public function showPaciente($paciente_id)
    {
        $medico = auth()->user();
        $paciente = Paciente::whereHas('consultas', function($query) use ($medico, $paciente_id) {
            $query->where('med_codigo', $medico->med_codigo)->where('pac_codigo', $paciente_id);
        })->firstOrFail();
        return response()->json($paciente);
    }
}
