<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedules;

use Redirect;

class SchedulesController extends Controller
{
	public function index()
	{
		# list schedules
		$schedules = Schedules::leftJoin('patients', function ($join){
									$join->on('patients.id', '=', 'schedules.patients_id');
							   })
							   ->leftJoin('doctors', function ($join){
									$join->on('doctors.id', '=', 'schedules.doctors_id');
							   })
							   ->select(
								   'schedules.*',
								   'patients.name as namePatient',
								   'doctors.name as nameDoctor'
							   )
							   ->get();

		# list patients
		$patients = Patient::all();

		# list schedules
		$doctors = Doctor::all();

		return view('schedules.schedules', [
			'action'    => 'add',
			'schedules'	=> $schedules,
			'patients'	=> $patients,
			'doctors'	=> $doctors,
		]);
	}


	public function store(Request $request)
	{
		$validator = validator($request->all(), [
			'type' => 'required',
			'date' => 'required',
			'patients_id' => 'required',
			'doctors_id' => 'required',
		]);

		if ($validator->fails()) {

			Session::flash('message', 'Preencha todos os campos obrigatórios!');
			Session::flash('alert-class', 'alert-danger');

        }

		$schedule = new Schedules;

		if ($request->date) {
			list($date, $hour) = explode(' ', $request->date);
			$date = implode('-', array_reverse(explode('/', $date)));
			$concat = $date . ' ' . $hour;
		}
		
		# params
		$schedule->type                 = $request->type;
		$schedule->date                 = ((isset($concat)) ? $concat . ':00' : NULL);
		$schedule->patients_id          = $request->patients_id;
		$schedule->doctors_id           = $request->doctors_id;
		$schedule->medical_insurance    = $request->medical_insurance;
		$schedule->value                = str_replace(',', '.', str_replace('.', '', $request->value));
		$schedule->note                 = $request->note;
		$schedule->is_active            = (($request->is_active == 1) ? 1 : NULL);
		if ($schedule->save()) {

			Session::flash('message', 'Agendamento cadastrado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível cadastrar o agendamento!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('schedules'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function edit($id)
	{
		# schedule selecionado
		$schedule = Schedules::where('id', $id);
		if ($schedule->exists()) {

			$scheduleSelect = $schedule->first();

			# list schedules
			$schedules = Schedules::leftJoin('patients', function ($join){
										$join->on('patients.id', '=', 'schedules.patients_id');
									})
									->leftJoin('doctors', function ($join){
											$join->on('doctors.id', '=', 'schedules.doctors_id');
									})
									->select(
										'schedules.*',
										'patients.name as namePatient',
										'doctors.name as nameDoctor'
									)
									->get();

			# list patients
			$patients = Patient::all();
	
			# list schedules
			$doctors = Doctor::all();

			return view('schedules.schedules', [
				'action'            => 'edit',
				'scheduleSelect'	=> $scheduleSelect,
				'schedules'			=> $schedules,
				'patients'			=> $patients,
				'doctors'			=> $doctors,
			]);

		} else { return redirect()->route('schedules'); }
	}


	public function update(Request $request)
	{		
        $validator = validator($request->all(), [
			'type' => 'required',
			'date' => 'required',
			'patients_id' => 'required',
			'doctors_id' => 'required',
		]);

		if ($validator->fails()) {
			
			Session::flash('message', 'Preencha todos os campos obrigatórios!');
			Session::flash('alert-class', 'alert-danger');

		}
		if ($request->date) {
			list($date, $hour) = explode(' ', $request->date);
			$date = implode('-', array_reverse(explode('/', $date)));
			$concat = $date . ' ' . $hour . ':00';
		}

		$update = Schedules::findOrFail($request->id);

		# params
		$update->type                 = $request->type;
		$update->date                 = ((isset($concat)) ? $concat : NULL);
		$update->patients_id          = $request->patients_id;
		$update->doctors_id           = $request->doctors_id;
		$update->medical_insurance    = $request->medical_insurance;
		$update->value                = str_replace(',', '.', str_replace('.', '', $request->value));
		$update->note                 = $request->note;
		$update->is_active            = (($request->is_active == 1) ? 1 : NULL);
		if ($update->save()) {

			Session::flash('message', 'Agendamento editado com sucesso!');
			Session::flash('alert-class', 'alert-success');

		} else {

			Session::flash('message', 'Não foi possível editar o agendamento!');
			Session::flash('alert-class', 'alert-danger');

		}

		return Redirect::to(route('schedules'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
	}


	public function destroy($id)
	{
		$schedule = Schedules::find($id);
		if ($schedule) {

			$destroy = Schedules::destroy($id);

		}

		return Redirect::to(route('schedules'))
						 ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		
	}

}