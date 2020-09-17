@extends('layouts.theme')

@section('content')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
        <div class="col-md-12">
    
            <h3>Teste Full Stack – Mazzatech</h3>

            <hr>

            <p>Olá pessoal, é um prazer fazer este desafio! </p>

            <p>Desde já, gostaria de agradecer a oportunidade.</p>

            <hr>

            <strong>Setup:</strong>
            <p>-   1 - cp .env.example .env - Configure as credenciais no arquivo .env com dados do banco de dados</p>

            <hr>

            <strong>Tecnologias:</strong>
            <p>-   Laravel</p>
            <p>-   MySQL</p>


            <strong>Desafio</strong><br>
            Front End:<br>
            <p>-  [x] Criação da interface do sistema utilizando Bootstrap • Gerenciar as dependências do Front usando bower , yarn ou  webpack </p>
            <p>-  [x] Escrever css utilizando de prefência algum pré processador (  SASS, LESS , STYLUS). Preferimos o primeiro. </p>
            <p>-  [x] Uilizar o plugin Datatables para listagem dos registros. </p>

            Back End:<br>
            <p>-  [x] Criação do Banco de Dados ( Usuários, Pacientes, Médicos,  Agendamentos ) </p>
            <p>-  [x] Criação de CRUD para Usuários, Pacientes, Médicos,  Agendamentos. </p>
            <p>-  [x] Criação de um recurso de API Rest para exibição dos médicos em  um aplicativo. O formato deverá ser um JSON. </p></p>


            <strong>Informações de dados</strong><br>
            <strong>Pacientes</strong>
            <p>-   id</br>
            -   name</br>
            -   date_of_birth</br>
            -   gender</br>
            -   phone</br>
            -   cell_phone</br>
            -   is_active [ativo, bloqueado]</p>

            <strong>Médicos</strong>
            <p>-   id</br>
            -   name</br>
            -   specialization</br>
            -   email</br>
            -   date_of_birth</br>
            -   gender</br>
            -   phone</br>
            -   is_active [ativo, bloqueado]</p>

            <strong>Agendamentos</strong>
            <p>-   id</br>
            -   type [consulta, retorno]</br>
            -   date</br>
            -   patients_id</br>
            -   doctors_id</br>
            -   medical_insurance</br>
            -   value</br>
            -   note</br>
            -   is_active [Não chegou o dia, Em Espera, Em Atendimento, Fianlizado]</p>

            <hr>

            <p><p>-   Desafio iniciado em: 16/09/2020 21:00</p>
            <p><p>-   Desafio finalizado em: 17/09/2020 12:45</p>

        </div>
    </div>

</main>

@endsection