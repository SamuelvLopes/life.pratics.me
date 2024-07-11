<?php

namespace App\Http\Controllers\Admin;

use App\Models\Medico;
use App\Models\Consulta;
use App\Models\Paciente;
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

    // Exibe um médico específico
    public function show($id)
    {
        $medico = Medico::findOrFail($id);
        return response()->json($medico);
    }

    // Atualiza um médico existente no banco de dados
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

    // Remove um médico do banco de dados
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return response()->json([
            'message' => 'Médico removido com sucesso!'
        ]);
    }

    // Lista as consultas do médico autenticado
    public function listConsultas()
    {
        $medico = auth()->user();
        $consultas = Consulta::where('med_codigo', $medico->med_codigo)->get();
        return response()->json($consultas);
    }

    // Exibe uma consulta específica do médico autenticado
    public function showConsulta($consulta_id)
    {
        $medico = auth()->user();
        $consulta = Consulta::where('med_codigo', $medico->med_codigo)->where('cons_codigo', $consulta_id)->firstOrFail();
        return response()->json($consulta);
    }

    // Lista os pacientes do médico autenticado
    public function listPacientes()
    {
        $medico = auth()->user();
        $consultas = Consulta::where('med_codigo', $medico->med_codigo)->pluck('pac_codigo');
        $pacientes = Paciente::whereIn('pac_codigo', $consultas)->get();
        return response()->json($pacientes);
    }

    // Exibe um paciente específico do médico autenticado
    public function showPaciente($paciente_id)
    {
        $medico = auth()->user();
        $paciente = Paciente::whereHas('consultas', function($query) use ($medico, $paciente_id) {
            $query->where('med_codigo', $medico->med_codigo)->where('pac_codigo', $paciente_id);
        })->firstOrFail();
        return response()->json($paciente);
    }
}
