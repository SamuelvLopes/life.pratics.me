<?php

namespace App\Http\Controllers\Admin;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Tag(
 *     name="Procedimentos",
 *     description="API Endpoints de Procedimentos RESTRITO AO ADMIN"
 * )
 */
class ProcedimentoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/procedimentos",
     *     tags={"Procedimentos"},
     *     summary="Exibe uma lista de procedimentos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de procedimentos"
     *     )
     * )
     */
    public function index()
    {
        $procedimentos = Procedimento::all();
        return response()->json($procedimentos);
    }

    /**
     * @OA\Post(
     *     path="/procedimentos",
     *     tags={"Procedimentos"},
     *     summary="Armazena um novo procedimento",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="proc_nome", type="string", example="Consulta Geral"),
     *             @OA\Property(property="proc_valor", type="number", format="float", example=150.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Procedimento criado com sucesso"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'proc_nome' => 'required|string|max:255',
            'proc_valor' => 'required|numeric',
        ]);

        $procedimento = Procedimento::create([
            'proc_nome' => $request->proc_nome,
            'proc_valor' => $request->proc_valor,
        ]);

        return response()->json([
            'message' => 'Procedimento criado com sucesso!',
            'procedimento' => $procedimento
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/procedimentos/{id}",
     *     tags={"Procedimentos"},
     *     summary="Exibe um procedimento específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do procedimento"
     *     )
     * )
     */
    public function show($id)
    {
        $procedimento = Procedimento::findOrFail($id);
        return response()->json($procedimento);
    }

    /**
     * @OA\Put(
     *     path="/procedimentos/{id}",
     *     tags={"Procedimentos"},
     *     summary="Atualiza um procedimento específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="proc_nome", type="string", example="Consulta Especializada"),
     *             @OA\Property(property="proc_valor", type="number", format="float", example=200.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Procedimento atualizado com sucesso"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'proc_nome' => 'sometimes|required|string|max:255',
            'proc_valor' => 'sometimes|required|numeric',
        ]);

        $procedimento = Procedimento::findOrFail($id);
        $procedimento->update($request->all());

        return response()->json([
            'message' => 'Procedimento atualizado com sucesso!',
            'procedimento' => $procedimento
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/procedimentos/{id}",
     *     tags={"Procedimentos"},
     *     summary="Remove um procedimento específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Procedimento removido com sucesso"
     *     )
     * )
     */
    public function destroy($id)
    {
        $procedimento = Procedimento::findOrFail($id);
        $procedimento->delete();

        return response()->json([
            'message' => 'Procedimento removido com sucesso!'
        ]);
    }
}
