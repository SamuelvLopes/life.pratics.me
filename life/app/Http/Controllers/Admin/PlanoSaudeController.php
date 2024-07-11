<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlanoSaude;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Tag(
 *     name="Planos de Saúde",
 *     description="API Endpoints de Planos de Saúde restrito ao admin"
 * )
 */
class PlanoSaudeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/planos",
     *     tags={"Planos de Saúde"},
     *     summary="Exibe uma lista de planos de saúde",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de planos de saúde"
     *     )
     * )
     */
    public function index()
    {
        $planos = PlanoSaude::all();
        return response()->json($planos);
    }

    /**
     * @OA\Post(
     *     path="/planos",
     *     tags={"Planos de Saúde"},
     *     summary="Armazena um novo plano de saúde",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="plano_descricao", type="string", example="Plano Básico")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plano de saúde criado com sucesso"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Valida os dados da requisição
        $request->validate([
            'plano_descricao' => 'required|string|max:255',
        ]);

        // Cria um novo plano de saúde
        $plano = PlanoSaude::create([
            'plano_descricao' => $request->plano_descricao,
        ]);

        // Retorna a resposta JSON
        return response()->json([
            'message' => 'Plano de saúde criado com sucesso!',
            'plano' => $plano
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/planos/{id}",
     *     tags={"Planos de Saúde"},
     *     summary="Exibe um plano de saúde específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do plano de saúde"
     *     )
     * )
     */
    public function show($id)
    {
        $plano = PlanoSaude::findOrFail($id);
        return response()->json($plano);
    }

    /**
     * @OA\Put(
     *     path="/planos/{id}",
     *     tags={"Planos de Saúde"},
     *     summary="Atualiza um plano de saúde específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="plano_descricao", type="string", example="Plano Premium")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plano de saúde atualizado com sucesso"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        // Valida os dados da requisição
        $request->validate([
            'plano_descricao' => 'sometimes|required|string|max:255',
        ]);

        // Busca o plano de saúde pelo ID e atualiza os dados
        $plano = PlanoSaude::findOrFail($id);
        $plano->update($request->all());

        // Retorna a resposta JSON
        return response()->json([
            'message' => 'Plano de saúde atualizado com sucesso!',
            'plano' => $plano
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/planos/{id}",
     *     tags={"Planos de Saúde"},
     *     summary="Remove um plano de saúde específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plano de saúde removido com sucesso"
     *     )
     * )
     */
    public function destroy($id)
    {
        $plano = PlanoSaude::findOrFail($id);
        $plano->delete();

        return response()->json([
            'message' => 'Plano de saúde removido com sucesso!'
        ]);
    }
}
