<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
@include('header')
<body>
    <div class="wrapper" id="app">
        <!-- incluindo Sidebar -->
        @include('sidebar')

        <div class="main-panel">
            <!-- incluindo Navbar -->
            @include('navbar')

            <!-- conteúdo principal -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <h4 class="card-title">Pacientes</h4>
                                    <p class="card-category">Listagem de Pacientes cadastrados</p>
                                </div>
                                <a href="{{ url('paciente/edit/0') }}"><button id="new_agend" type="button" class="btn btn-info btn-fill pull-left pr-1">Novo Paciente</button></a>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped" id="pacientes_table">
                                        <thead>
                                            <th>CPF/CNPJ</th>
                                            <th>Nome</th>
                                            <th>Celular</th>
                                            <th>Sexo</th>
                                            <th>Data Nascimento</th>
                                            <th>Cidade</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </thead>
                                        <tbody>
                                        @foreach($pacientes as $key => $paciente)
                                            <tr>
                                                <td>{{$paciente['cpf_cnpj']}}</td>
                                                <td>{{$paciente['nome']}}</td>
                                                <td>{{$paciente['celular']}}</td>
                                                <td>{{$paciente['sexo']}}</td>
                                                <td>{{$paciente['data_nascimento']}}</td>
                                                <td>{{$paciente['cidade']}}</td>
                                                <td><a href="{{ url('paciente/edit') . '/'. $paciente['id'] }}"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg></a>
                                                </td>
                                                <td name="user_delete"><a href="{{ url('paciente/delete') . '/'. $paciente['id'] }}"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-x-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<script type="module" type="text/javascript">
$(document).ready(function() {
    $('#pacientes_table').DataTable();

    $('[name="user_delete"]').click(function() {
        if(confirm("Deseja apagar este paciente?") == true) {
            return true;
        } else{
            return false;
        }
    });
});
</script>