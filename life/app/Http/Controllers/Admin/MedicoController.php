<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicoController extends Controller
{
    // Exibe uma lista de médicos
    public function index()
    {
        $medicos = Medico::all();
        return response()->json($medicos);
    }

    // Armazena um novo médico no banco de dados
    public function store(Request $request)
    {
        // Valida os dados da requisição
        

        // Cria um novo médico
        $medico = Medico::create([
            'med_crm' => $request->med_crm,
            'med_nome' => $request->med_nome,
            'med_email' => $request->med_email,
            'med_password' => $request->med_password,
        ]);

        // Retorna a resposta JSON
        return response()->json([
            'message' => 'Médico criado com sucesso!',
            'medico' => $medico
        ], 201);
    }

    // Exibe um médico específico
    public function show($id)
    {
        $medico = Medico::findOrFail($id);
        return response()->json($medico);
    }

    // Atualiza um médico existente no banco de dados
    public function update(Request $request, $id)
    {
        // Valida os dados da requisição
        $request->validate([
            'med_crm' => 'required|string|max:255|unique:medico,med_crm' ,
            'med_nome' => 'required|string|max:255',
            'med_email' => 'required|string|email|max:255|unique:medico,med_email',
            'med_password' => 'required|string|min:8|max:255',
        ]);

        // Busca o médico pelo ID e atualiza os dados
        $medico = Medico::findOrFail($id);
        $medico->update($request->all());

        // Retorna a resposta JSON
        return response()->json([
            'message' => 'Médico atualizado com sucesso!',
            'medico' => $medico
        ]);
    }

    // Remove um médico do banco de dados
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json([
            'message' => 'Médico removido com sucesso!'
        ]);
    }
}
