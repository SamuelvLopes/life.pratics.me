<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Consulta;
use App\Models\Procedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


/**
 * @OA\Tag(
 *     name="Paciente",
 *     description="API Endpoints de Paciente"
 * )
 */
class PacienteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pacientes",
     *     tags={"Admin|Paciente"},
     *     summary="Exibe uma lista de pacientes",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes"
     *     )
     * )
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

     /**
     * @OA\Post(
     *     path="/pacientes",
     *     tags={"Admin|Paciente"},
     *     summary="Armazena um novo paciente no banco de dados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pac_nome", type="string", example="João Silva"),
     *             @OA\Property(property="pac_data_nascimento", type="string", format="date", example="1980-01-01"),
     *             @OA\Property(property="pac_email", type="string", example="joao.silva@example.com"),
     *             @OA\Property(property="pac_password", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente criado com sucesso"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'pac_nome' => 'required|string|max:255',
            'pac_data_nascimento' => 'required|date',
            'pac_email' => 'required|string|email|max:255|unique:paciente,pac_email',
            'pac_password' => 'required|string|min:8|max:255',
        ]);

        $paciente = Paciente::create([
            'pac_nome' => $request->pac_nome,
            'pac_data_nascimento' => $request->pac_data_nascimento,
            'pac_email' => $request->pac_email,
            'pac_password' => bcrypt($request->pac_password),
        ]);

        return response()->json([
            'message' => 'Paciente criado com sucesso!',
            'paciente' => $paciente
        ], 201);
    }

     /**
     * @OA\Get(
     *     path="/pacientes/{id}",
     *     tags={"Admin|Paciente"},
     *     summary="Exibe um paciente específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do paciente"
     *     )
     * )
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return response()->json($paciente);
    }

     /**
     * @OA\Put(
     *     path="/pacientes/{id}",
     *     tags={"Admin|Paciente"},
     *     summary="Atualiza um paciente existente no banco de dados",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pac_nome", type="string", example="João Silva"),
     *             @OA\Property(property="pac_data_nascimento", type="string", format="date", example="1980-01-01"),
     *             @OA\Property(property="pac_email", type="string", example="joao.silva@example.com"),
     *             @OA\Property(property="pac_password", type="string", example="senha123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente atualizado com sucesso"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pac_nome' => 'sometimes|required|string|max:255',
            'pac_data_nascimento' => 'sometimes|required|date',
            'pac_email' => 'sometimes|required|string|email|max:255|unique:paciente,pac_email,' . $id . ',pac_codigo',
            'pac_password' => 'sometimes|required|string|min:8|max:255',
        ]);

        $paciente = Paciente::findOrFail($id);

        $data = $request->all();
        if ($request->filled('pac_password')) {
            $data['pac_password'] = bcrypt($request->pac_password);
        } else {
            unset($data['pac_password']);
        }

        $paciente->update($data);

        return response()->json([
            'message' => 'Paciente atualizado com sucesso!',
            'paciente' => $paciente
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/pacientes/{id}",
     *     tags={"Admin|Paciente"},
     *     summary="Remove um paciente do banco de dados",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente removido com sucesso"
     *     )
     * )
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return response()->json([
            'message' => 'Paciente removido com sucesso!'
        ]);
    }

    /**
     * @OA\Post(
     *     path="/pacientes/consultas",
     *     tags={"Paciente","Consulta"},
     *     summary="Marca uma nova consulta",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="med_codigo", type="integer", example=1),
     *             @OA\Property(property="cons_horario", type="string", format="date-time", example="2024-07-11T10:00:00Z"),
     *             @OA\Property(property="procedimentos", type="array", @OA\Items(type="integer"), example={1, 2, 3})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Consulta marcada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao marcar a consulta"
     *     )
     * )
     */
    public function marcarConsulta(Request $request)
    {
        $request->validate([
            'med_codigo' => 'required|exists:medico,med_codigo',
            'cons_horario' => 'required|date',
            'procedimentos' => 'required|array',
            'procedimentos.*' => 'exists:procedimento,proc_codigo',
        ]);

        $medico = Medico::findOrFail($request->med_codigo);
        $procedimentos = Procedimento::whereIn('proc_codigo', $request->procedimentos)->get();

        foreach ($procedimentos as $procedimento) {
            $especialidades = $procedimento->especialidades()->pluck('especialidade.espec_codigo')->toArray();
            $medicoEspecialidades = $medico->especialidades()->pluck('especialidade.espec_codigo')->toArray();

            if (!array_intersect($especialidades, $medicoEspecialidades)) {
                return response()->json(['error' => 'O médico não possui a especialidade necessária para um dos procedimentos.'], 400);
            }
        }

        $consulta = Consulta::create([
            'pac_codigo' => auth()->user()->pac_codigo,
            'med_codigo' => $request->med_codigo,
            'cons_horario' => $request->cons_horario,
            'cons_particular' => $request->cons_particular ?? false,
        ]);

        $consulta->procedimentos()->attach($request->procedimentos);

        return response()->json([
            'message' => 'Consulta marcada com sucesso!',
            'consulta' => $consulta->load('procedimentos')
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/pacientes/consultas",
     *     tags={"Paciente","Consulta"},
     *     summary="Lista as consultas do paciente autenticado",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de consultas"
     *     )
     * )
     */
    public function listarConsultas()
    {
        $consultas = Consulta::where('pac_codigo', auth()->user()->pac_codigo)->with('procedimentos')->get();
        return response()->json($consultas);
    }

    /**
     * @OA\Get(
     *     path="/pacientes/consultas/{consulta_id}",
     *     tags={"Paciente","Consulta"},
     *     summary="Exibe uma consulta específica do paciente autenticado",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="consulta_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados da consulta",
     *         @OA\JsonContent(
     *             @OA\Property(property="cons_codigo", type="integer", example=1),
     *             @OA\Property(property="cons_horario", type="string", format="date-time", example="2024-07-11T10:00:00Z"),
     *             @OA\Property(property="cons_particular", type="boolean", example=false),
     *             @OA\Property(property="pac_codigo", type="integer", example=1),
     *             @OA\Property(property="med_codigo", type="integer", example=1),
     *             @OA\Property(property="procedimentos", type="array", @OA\Items(
     *                 @OA\Property(property="proc_codigo", type="integer", example=1),
     *                 @OA\Property(property="proc_nome", type="string", example="Consulta de rotina")
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Consulta não encontrada"
     *     )
     * )
     */
    public function mostrarConsulta($consulta_id)
    {
        $consulta = Consulta::where('pac_codigo', auth()->user()->pac_codigo)
                            ->where('cons_codigo', $consulta_id)
                            ->with('procedimentos')
                            ->firstOrFail();
        return response()->json($consulta);
    }
}
