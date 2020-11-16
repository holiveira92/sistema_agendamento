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
                                    <h4 class="card-title">Agendamentos</h4>
                                    <p class="card-category">Listagem de Todos os Agendamentos Realizados</p>
                                </div>
                                <a href="{{ url('agendamentos/edit/0') }}"><button id="new_agend" type="button" class="btn btn-info btn-fill pull-left pr-1">Novo Agendamento</button></a>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped" id="agendamentos_table">
                                        <thead>
                                            <th>ID</th>
                                            <th>Horário Início</th>
                                            <th>Horário Fim</th>
                                            <th>Médico</th>
                                            <th>Paciente</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </thead>
                                        <tbody>
                                        @foreach($agendamentos as $key => $agendamento)
                                            <tr>
                                                <td>{{$agendamento['id']}}</td>
                                                <td>{{ date('d/m/Y H:i',strtotime($agendamento['horario_inicio'])) }}</td>
                                                <td>{{ date('d/m/Y H:i',strtotime($agendamento['horario_fim'])) }}</td>
                                                <td>{{$agendamento['nome_medico']}}</td>
                                                <td>{{$agendamento['nome_paciente']}}</td>
                                                <td><a href="{{ url('agendamentos/edit') . '/'. $agendamento['id'] }}"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                    </svg></a>
                                                </td>
                                                <td name="agendamentos_delete"><a href="{{ url('agendamentos/delete') . '/'. $agendamento['id'] }}"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-calendar2-x-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 3.5c0-.276.244-.5.545-.5h10.91c.3 0 .545.224.545.5v1c0 .276-.244.5-.546.5H2.545C2.245 5 2 4.776 2 4.5v-1zm4.854 4.646a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293 6.854 8.146z"/></svg>
                                                </a>
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
    $('#agendamentos_table').DataTable();

    $('[name="agendamentos_delete"]').click(function() {
        if(confirm("Deseja apagar este agendamento?") == true) {
            return true;
        } else{
            return false;
        }
    });
});
</script>