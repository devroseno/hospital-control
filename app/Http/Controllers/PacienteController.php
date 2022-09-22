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
        return response()->json([
           "pacientes"=>$pacientes,
        ]);
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
