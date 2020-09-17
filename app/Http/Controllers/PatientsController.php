<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Patient;

use Redirect;

class PatientsController extends Controller
{
	public function index()
	{
		# list patients
		$patients = Patient::all();

		return view('patients.patients', [
			'action'    => 'add',
			'patients'  => $patients,
		]);
	}


	public function store(Request $request)
	{
		$validator = validator($request->all(), [
			'name' => 'required',
		]);

		if ($validator->fails()) {

			Session::flash('message', 'Preencha todos os campos obrigatórios!');
			Session::flash('alert-class', 'alert-danger');

		}

		$patient = new Patient;
		
		# params
		$patient->name			= $request->name;
		$patient->date_of_birth	= (($request->date_of_birth) ? implode('-', array_reverse(explode('/', $request->date_of_birth))) : NULL);
		$patient->gender		= $request->gender;
		$patient->phone			= $request->descrphoneiption;
		$patient->cell_phone	= $request->cell_phone;
		$patient->is_active		= (($request->is_active == 1) ? 1 : NULL);
		if ($patient->save()) {

			Session::flash('message', 'Paciente cadastrado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível cadastrar o paciente!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('patients'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function edit($id)
	{
		# patient selecionado
		$patient = Patient::where('id', $id);
		if ($patient->exists()) {

			$patientSelect = $patient->first();

			# patients
			$patients = Patient::all();

			return view('patients.patients', [
				'action'		=> 'edit',
				'patientSelect'	=> $patientSelect,
				'patients'		=> $patients,
			]);

		} else { return redirect()->route('patients'); }
	}


	public function update(Request $request)
	{		
        $validator = validator($request->all(), [
			'name' => 'required',
		]);

		if ($validator->fails()) {
			
			Session::flash('message', 'Preencha todos os campos obrigatórios!');
			Session::flash('alert-class', 'alert-danger');

		}

		$update = Patient::findOrFail($request->id);

		# params
		$update->name			= $request->name;
		$update->date_of_birth	= (($request->date_of_birth) ? implode('-', array_reverse(explode('/', $request->date_of_birth))) : NULL);
		$update->gender			= $request->gender;
		$update->phone			= $request->descrphoneiption;
		$update->cell_phone		= $request->cell_phone;
		$update->is_active		= (($request->is_active == 1) ? 1 : NULL);
		if ($update->save()) {

			Session::flash('message', 'Paciente editado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível editar o paciente!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('patients'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function destroy($id)
	{
		$patient = Patient::find($id);
		if ($patient) {

			$destroy = Patient::destroy($id);

		}

		return Redirect::to(route('patients'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		
	}

}