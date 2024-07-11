<?php

namespace App\Http\Controllers\Admin;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcedimentoController extends Controller
{
    public function index()
    {
        $procedimentos = Procedimento::all();
        return response()->json($procedimentos);
    }

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

    public function show($id)
    {
        $procedimento = Procedimento::findOrFail($id);
        return response()->json($procedimento);
    }

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

    public function destroy($id)
    {
        $procedimento = Procedimento::findOrFail($id);
        $procedimento->delete();

        return response()->json([
            'message' => 'Procedimento removido com sucesso!'
        ]);
    }
}
