<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Especialidades",
 *     description="API Endpoints de Especialidades disponivel restrito admin"
 * )
 */

class EspecialidadeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/especialidades",
     *     tags={"Especialidades","Admin"},
     *     summary="Exibe uma lista de especialidades",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de especialidades"
     *     )
     * )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/especialidades",
     *     tags={"Especialidades","Admin"},
     *     summary="Armazena uma nova especialidade",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Cardiologia")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Especialidade criada com sucesso"
     *     )
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/especialidades/{id}",
     *     tags={"Especialidades","Admin"},
     *     summary="Exibe uma especialidade específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados da especialidade"
     *     )
     * )
     */
    public function show(string $id)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/especialidades/{id}",
     *     tags={"Especialidades","Admin"},
     *     summary="Atualiza uma especialidade específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string", example="Neurologia")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Especialidade atualizada com sucesso"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/especialidades/{id}",
     *     tags={"Especialidades","Admin"},
     *     summary="Remove uma especialidade específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Especialidade removida com sucesso"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        //
    }
}
