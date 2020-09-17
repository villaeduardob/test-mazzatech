<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

use Redirect;

class DoctorsController extends Controller
{
	public function index()
	{
		# list doctors
		$doctors = Doctor::all();

		return view('doctors.doctors', [
			'action'    => 'add',
			'doctors'  => $doctors,
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

        $doctor = new Doctor;
        
		# params
		$doctor->name           = $request->name;
		$doctor->specialization = $request->specialization;
		$doctor->email          = $request->email;
		$doctor->date_of_birth  = (($request->date_of_birth) ? implode('-', array_reverse(explode('/', $request->date_of_birth))) : NULL);
		$doctor->gender         = $request->gender;
		$doctor->phone          = $request->phone;
		$doctor->cell_phone     = $request->cell_phone;
		$doctor->is_active      = (($request->is_active == 1) ? 1 : NULL);
		if ($doctor->save()) {

			Session::flash('message', 'Médico cadastrado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível cadastrar o médico!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('doctors'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function edit($id)
	{
		# doctor selecionado
		$doctor = Doctor::where('id', $id);
		if ($doctor->exists()) {

			$doctorSelect = $doctor->first();

			# list doctors
			$doctors = Doctor::all();

			return view('doctors.doctors', [
				'action'		=> 'edit',
				'doctorSelect'	=> $doctorSelect,
				'doctors'		=> $doctors,
			]);

		} else { return redirect()->route('doctors'); }
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

		$update = Doctor::findOrFail($request->id);

        # params
        $update->name           = $request->name;
		$update->specialization = $request->specialization;
		$update->email          = $request->email;
		$update->date_of_birth  = (($request->date_of_birth) ? implode('-', array_reverse(explode('/', $request->date_of_birth))) : NULL);
		$update->gender         = $request->gender;
		$update->phone          = $request->phone;
		$update->cell_phone     = $request->cell_phone;
        $update->is_active      = (($request->is_active == 1) ? 1 : NULL);
		if ($update->save()) {

			Session::flash('message', 'Médico editado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível editar o médico!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('doctors'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function destroy($id)
	{
		$doctor = Doctor::find($id);
		if ($doctor) {

			$destroy = Doctor::destroy($id);

		}

		return Redirect::to(route('doctors'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		
	}

}