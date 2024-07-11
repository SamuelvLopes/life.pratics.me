<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlanoSaude;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanoSaudeController extends Controller
{
    // Exibe uma lista de planos de saúde
    public function index()
    {
        $planos = PlanoSaude::all();
        return response()->json($planos);
    }

    // Armazena um novo plano de saúde no banco de dados
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

    // Exibe um plano de saúde específico
    public function show($id)
    {
        $plano = PlanoSaude::findOrFail($id);
        return response()->json($plano);
    }

    // Atualiza um plano de saúde existente no banco de dados
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

    // Remove um plano de saúde do banco de dados
    public function destroy($id)
    {
        $plano = PlanoSaude::findOrFail($id);
        $plano->delete();

        return response()->json([
            'message' => 'Plano de saúde removido com sucesso!'
        ]);
    }
}
