<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    
	public function index() {
		return view('index');
		
	}

	public function fetchAll() {
		$pacientes = Paciente::all();

		$output = '';
		if ($pacientes->count() > 0) {
			$output .= '<table class="table table-hover table-sm text-center align-middle">
            <thead>
              <tr>
                <th>FOTO</th>
                <th>NOME</th>
                <th>NASCIMENTO</th>
                <th>CPF</th>
                <th>WHATSAPP</th>
				<th>STATUS</th>
                <th>AÇÕES</th>
              </tr>
            </thead>
            <tbody>';
			
			foreach ($pacientes as $paciente) {
				$output .= '<tr>
                <td><img src="storage/images/' . $paciente->avatar . '" style="width: 50px; height:50px; border-radius:100%;" class="img-thumbnail rounded-circle"></td>
                <td>' . $paciente->nome . '</td>
                <td>' . $paciente->idade . '</td>
                <td>' . $paciente->cpf . '</td>
                <td>' . $paciente->wpp . '</td>
				<td>' . $paciente->status . '</td>
                <td>
                  <a href="#" id="' . $paciente->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPacienteModal"><i class="bi-pencil-square h4"></i></a>
                  <a href="#" id="' . $paciente->id . '" class="text-danger mx-1 deleteIcon"><i class="bi bi-trash-fill h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">Nenhum paciente cadastrado!</h1>';
		}
		
	}

	public function store(Request $request) {
		$file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$pacienteData = [
			'nome' => $request->nome,
			'idade' => $request->idade,
			'dia' => $request->dia,
			'mes' => $request->mes,
			'ano' => $request->ano,
			'cpf' => $request->cpf, 
			'wpp' => $request->wpp,
			'sintomas' => $request->sintomas, 
			'avatar' => $fileName
		];
		Paciente::create($pacienteData);
		return response()->json([
			'status' => 200,
		]);
	}

    public function edit(Request $request) {
		$id = $request->id;
		$paciente = Paciente::find($id);
		return response()->json($paciente);
	}

    public function update(Request $request) {
		$fileName = '';
		$paciente = Paciente::find($request->paciente_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($paciente->avatar) {
				Storage::delete('public/images/' . $paciente->avatar);
			}
		} else {
			$fileName = $request->paciente_avatar;
		}

		$pacienteData = [
			'nome' => $request->nome,
			'idade' => $request->idade,
			'dia' => $request->dia,
			'mes' => $request->mes,
			'ano' => $request->ano,
			'cpf' => $request->cpf, 
			'wpp' => $request->wpp,
			'sintomas' => $request->sintomas, 
			'avatar' => $fileName
		];

		$paciente->update($pacienteData);
		return response()->json([
			'status' => 200,
		]);
	}

    public function delete(Request $request) {
		$id = $request->id;
		$paciente = Paciente::find($id);
		if (Storage::delete('public/images/' . $paciente->avatar)) {
			Paciente::destroy($id);
		}
	}
	
}
