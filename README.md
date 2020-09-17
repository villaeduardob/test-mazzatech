<hr>

Olá pessoal, é um prazer fazer este desafio! 

Desde já, gostaria de agradecer a oportunidade.

<hr>

Setup:
-   1 - cp .env.example .env - Configure as credenciais no arquivo .env com dados do banco de dados

<hr>

## Tecnologias:
-   Laravel
-   MySQL


## Desafio
Front End:
-  [x] Criação da interface do sistema utilizando Bootstrap
-  [x] Gerenciar as dependências do Front usando bower , yarn ou  webpack 
-  [x] Escrever css utilizando de prefência algum pré processador (  SASS, LESS , STYLUS). Preferimos o primeiro. 
-  [x] Uilizar o plugin Datatables para listagem dos registros. 

Back End:
-  [x] Criação do Banco de Dados ( Usuários, Pacientes, Médicos,  Agendamentos ) 
-  [x] Criação de CRUD para Usuários, Pacientes, Médicos,  Agendamentos. 
-  [x] Criação de um recurso de API Rest para exibição dos médicos em  um aplicativo. O formato deverá ser um JSON. 


## Informações de dados
Pacientes
-   id
-   name
-   date_of_birth
-   gender
-   phone
-   cell_phone
-   is_active [ativo, bloqueado]

Médicos
-   id
-   name
-   specialization
-   email
-   date_of_birth
-   gender
-   phone
-   is_active [ativo, bloqueado]

Agendamentos
-   id
-   type [consulta, retorno]
-   date
-   patients_id
-   doctors_id
-   medical_insurance
-   value
-   note
-   is_active [Não chegou o dia, Em Espera, Em Atendimento, Fianlizado]

<hr>

-   Desafio iniciado em: 16/09/2020 21:00
-   Desafio finalizado em: 17/09/2020 12:45
