<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Consulta;
use App\Models\Procedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Exibe uma lista de pacientes
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    // Armazena um novo paciente no banco de dados
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

    // Exibe um paciente específico
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return response()->json($paciente);
    }

    // Atualiza um paciente existente no banco de dados
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

    // Remove um paciente do banco de dados
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return response()->json([
            'message' => 'Paciente removido com sucesso!'
        ]);
    }

    // Marca uma nova consulta
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

    // Lista as consultas do paciente autenticado
    public function listarConsultas()
    {
        $consultas = Consulta::where('pac_codigo', auth()->user()->pac_codigo)->with('procedimentos')->get();
        return response()->json($consultas);
    }

    // Exibe uma consulta específica do paciente autenticado
    public function mostrarConsulta($consulta_id)
    {
        $consulta = Consulta::where('pac_codigo', auth()->user()->pac_codigo)
                            ->where('cons_codigo', $consulta_id)
                            ->with('procedimentos')
                            ->firstOrFail();
        return response()->json($consulta);
    }
}
