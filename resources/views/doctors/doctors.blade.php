@extends('layouts.theme')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Médicos</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">

            <div class="table-responsive">
                <table class="table table-bordered datatable dataTable" id="tableItems">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Especialização</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($doctors as $row)

                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>
                                    <a class="pull-right" title="Excluir médico" onclick="return confirm('Deseja realmente excluir este médico?')" href="{{ route('doctors.destroy', $row->id) }}">
                                        <i class="fa fa-trash"></i>&nbsp;
                                    </a> 
                                    <a class="pull-right" title="Editar médico" href="{{ route('doctors.edit', $row->id) }}">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                    </a> 
                                    {{ $row->name }}
                                </td>
                                <td>{{ $row->specialization }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->cell_phone }}</td>
                                <td>
                                    <span class="badge badge-{{ (($row->is_active == 1) ? 'success' : 'danger') }}">
                                        {{ (($row->is_active == 1) ? 'Ativo' : 'Bloqueado') }}
                                    </span>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="col-md-4">

            <h4 id="overview">
                <div>{{ (($action == 'add') ? 'Cadastrar Médico' : 'Editar Médico #' . $doctorSelect->id) }}</div>
            </h4>

            @if($action == 'edit')
                <form action="{{ route('doctors.update') }}" id="formDoctors" method="post" role="form">
            @else
                <form action="{{ route('doctors.store') }}" id="formDoctors" method="post" role="form">
            @endif

                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
            
                @csrf
                <input type="hidden" name="action" value="{{ $action }}">
                @if ($action == 'edit')
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="id" value="{{ $doctorSelect->id }}">
                @endif

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="José da Silva" required value="{{ (($action == 'edit') ? $doctorSelect->name : NULL) }}" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="specialization">Especialização</label>
                    <input type="text" class="form-control" name="specialization" id="specialization" placeholder="Cardiologista" required value="{{ (($action == 'edit') ? $doctorSelect->specialization : NULL) }}" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="josedasilva@gmail.com" required value="{{ (($action == 'edit') ? $doctorSelect->email : NULL) }}" autocomplete="off">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_of_birth">Data de Nascimento</label>
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="{{ date('d/m/Y') }}" value="{{ (($action == 'edit') ? implode('/', array_reverse(explode('-', $doctorSelect->date_of_birth))) : NULL) }}" autocomplete="off">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gender">Gênero</label>
                        <select class="form-control" name="gender" id="gender">
                            <option>Selecione</option>
                            <option value="F" {{ (($action == 'edit') ? (($doctorSelect->gender == 'F') ? 'selected' : NULL) : NULL) }}>Feminino</option>
                            <option value="M" {{ (($action == 'edit') ? (($doctorSelect->gender == 'M') ? 'selected' : NULL) : NULL) }}>Masculino</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="(99) 9999-9999" value="{{ (($action == 'edit') ? $doctorSelect->phone : NULL) }}" autocomplete="off">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cell_phone">Celular</label>
                        <input type="text" class="form-control" name="cell_phone" id="cell_phone" placeholder="(99) 99999-9999" value="{{ (($action == 'edit') ? $doctorSelect->cell_phone : NULL) }}" autocomplete="off">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="is_active">Status</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1" {{ (($action == 'edit') ? (($doctorSelect->is_active == 1) ? 'selected' : NULL) : NULL) }}>Ativo</option>
                            <option value="0" {{ (($action == 'edit') ? (($doctorSelect->is_active == 0) ? 'selected' : NULL) : NULL) }}>Desativado</option>
                        </select>
                    </div>
                </div>

                <div class="float-right">
                    <button type="submit" class="btn btn-success">{{ (($action == 'add') ? 'Gravar' : 'Salvar') }}</button>
                </div>
            </form>

        </div>
    </div>
</main>

@endsection