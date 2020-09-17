@extends('layouts.theme')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
			<li class="breadcrumb-item active" aria-current="page">Agendamentos</li>
		</ol>
	</nav>

	<div class="row">
		<div class="col-md-8">

			<div class="table-responsive">
				<table class="table table-bordered datatable dataTable" id="tableItems">
					<thead>
						<tr>
							<th>#</th>
							<th>Data/Hora</th>
							<th>Tipo</th>
							<th>Paciente</th>
							<th>Médico</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

						@foreach($schedules as $row)

							<tr>
								<td>{{ $row->id }}</td>
								<td>
									<a class="pull-right" title="Excluir agendamento" onclick="return confirm('Deseja realmente excluir este agendamento?')" href="{{ route('schedules.destroy', $row->id) }}">
										<i class="fa fa-trash"></i>&nbsp;
									</a> 
									<a class="pull-right" title="Editar agendamento" href="{{ route('schedules.edit', $row->id) }}">
										<i class="fa fa-pencil"></i>&nbsp;
									</a> 
									{{ date('d/m/Y H:i', strtotime($row->date)) }}
								</td>
								<td>
									<?php 
										switch($row->type){
											case 1: $type = 'Consulta'; break;
											case 2: $type = 'Retorno'; break;
										}
									?>
									{{ $type }}
								</td>
								<td>{{ $row->namePatient }}</td>
								<td>{{ $row->nameDoctor }}</td>
								<td>
									<?php 
										switch($row->is_active){
											case 1: 
												$status = ''; 
												$badge = 'primary';
											break;
											case 2: 
												$status = 'Em Espera'; 
												$badge = 'warning'; 
											break;
											case 3: 
												$status = 'Em Atendimento'; 
												$badge = 'info'; 
											break;
											case 4: 
												$status = 'Fianlizado'; 
												$badge = 'success'; 
											break;
										}
									?>
									<span class="badge badge-{{ $badge }}">{{ $status }}</span>
								</td>
							</tr>
							
						@endforeach
					</tbody>
				</table>
			</div>

		</div>

		<div class="col-md-4">

			<h4 id="overview">
				<div>{{ (($action == 'add') ? 'Cadastrar Agendamento' : 'Editar Agendamento #' . $scheduleSelect->id) }}</div>
			</h4>

			@if($action == 'edit')
				<form action="{{ route('schedules.update') }}" id="formSchedules" method="post" role="form">
			@else
				<form action="{{ route('schedules.store') }}" id="formSchedules" method="post" role="form">
			@endif

				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
				@endif
			
				@csrf
				<input type="hidden" name="action" value="{{ $action }}">
				@if ($action == 'edit')
					<input type="hidden" name="_method" value="put">
					<input type="hidden" name="id" value="{{ $scheduleSelect->id }}">
				@endif

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="type">Tipo de Consulta</label>
						<select class="form-control" name="type" id="type" required>
							<option>Selecione</option>
							<option value="1" {{ (($action == 'edit') ? (($scheduleSelect->type == '1') ? 'selected' : NULL) : NULL) }}>Consulta</option>
							<option value="2" {{ (($action == 'edit') ? (($scheduleSelect->type == '2') ? 'selected' : NULL) : NULL) }}>Retorno</option>
						</select>
					</div>

					<div class="form-group col-md-6">
						<label for="date">Horário</label>
						<input type="text" class="form-control" name="date" id="date" placeholder="{{ date('d/m/Y H:i') }}" required value="{{ (($action == 'edit') ? date('d/m/Y H:i', strtotime($scheduleSelect->date)) : NULL) }}" autocomplete="off">
					</div>
				</div>

				<div class="form-group">
					<label for="patients_id">Paciente</label>
					<select class="form-control" name="patients_id" id="patients_id" required>
						<option value="">Selecione</option>
						@foreach($patients as $rowPatient)

							<option value="{{ $rowPatient->id }}" {{ (($action == 'edit') ? (($scheduleSelect->patients_id == $rowPatient->id) ? 'selected' : NULL) : NULL) }}>{{ $rowPatient->name }}</option>

						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="doctors_id">Médicos</label>
					<select class="form-control" name="doctors_id" id="doctors_id" required>
						<option value="">Selecione</option>
						@foreach($doctors as $rowDoctors)

							<option value="{{ $rowDoctors->id }}" {{ (($action == 'edit') ? (($scheduleSelect->doctors_id == $rowDoctors->id) ? 'selected' : NULL) : NULL) }}>{{ $rowDoctors->name }}</option>

						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="medical_insurance">Convênio</label>
					<input type="text" class="form-control" name="medical_insurance" id="medical_insurance" placeholder="Unimed" value="{{ (($action == 'edit') ? $scheduleSelect->medical_insurance : NULL) }}" autocomplete="off">
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="value">Valor da Consulta</label>
						<input type="text" class="form-control" name="value" id="value" placeholder="100,00" value="{{ (($action == 'edit') ? number_format($scheduleSelect->value, 2, ',', '.') : NULL) }}" autocomplete="off">
					</div>

					<div class="form-group col-md-6">
						<label for="is_active">Status</label>
						<select class="form-control" name="is_active" id="is_active">
							<option value="1" {{ (($action == 'edit') ? (($scheduleSelect->is_active == 1) ? 'selected' : NULL) : NULL) }}>Em Espera</option>
							<option value="2" {{ (($action == 'edit') ? (($scheduleSelect->is_active == 2) ? 'selected' : NULL) : NULL) }}>Em Espera</option>
							<option value="3" {{ (($action == 'edit') ? (($scheduleSelect->is_active == 3) ? 'selected' : NULL) : NULL) }}>Em Atendimento</option>
							<option value="4" {{ (($action == 'edit') ? (($scheduleSelect->is_active == 4) ? 'selected' : NULL) : NULL) }}>Finalizado</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="note">Observação</label>
					<textarea class="form-control" name="note" id="note" placeholder="Observação">{{ (($action == 'edit') ? $scheduleSelect->note : NULL) }}</textarea>
				</div>

				<div class="float-right">
					<button type="submit" class="btn btn-success">{{ (($action == 'add') ? 'Gravar' : 'Salvar') }}</button>
				</div>
			</form>

		</div>
	</div>
</main>

@endsection