<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Medico",
 *     description="API Endpoints for Managing Medicos"
 * )
 * 
 * @OA\Schema(
 *     schema="Medico",
 *     type="object",
 *     required={"name", "email", "crm"},
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="crm",
 *         type="string"
 *     )
 * )
 */
class MedicoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/medico/",
     *     tags={"Medico"},
     *     summary="Get a list of medicos",
     *     @OA\Response(
     *         response=200,
     *         description="A list with medicos"
     *     )
     * )
     */
    public function index()
    {
        // Lógica do método
    }

    /**
     * @OA\Post(
     *     path="/api/medico/",
     *     tags={"Medico"},
     *     summary="Store a newly created medico in storage",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Medico")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Medico created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Lógica do método
    }

    /**
     * @OA\Get(
     *     path="/api/medico/{id}",
     *     tags={"Medico"},
     *     summary="Display the specified medico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the medico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details of the specified medico"
     *     )
     * )
     */
    public function show(string $id)
    {
        // Lógica do método
    }

    /**
     * @OA\Put(
     *     path="/api/medico/{id}",
     *     tags={"Medico"},
     *     summary="Update the specified medico in storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the medico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Medico")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Medico updated successfully"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        // Lógica do método
    }

    /**
     * @OA\Delete(
     *     path="/api/medico/{id}",
     *     tags={"Medico"},
     *     summary="Remove the specified medico from storage",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the medico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Medico deleted successfully"
     *     )
     */
    public function destroy(string $id)
    {
        // Lógica do método
    }
}
