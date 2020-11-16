<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Agendamento</h4>
                                </div>
                                <div class="card-body">
                                    <form method="get" action="{{ url('agendamentos/update/') . '/' . $agendamento['id'] }}">
                                    <input type="hidden" name="agendamento_id" value="{{ $agendamento['id'] }}">
                                    <input type="hidden" name="horario_inicio" value="{{ $agendamento['horario_inicio'] }}">
                                    <input type="hidden" name="horario_fim" value="{{ $agendamento['horario_fim'] }}">
                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Médico</label>
                                                    <select name="medico" id="medico" class="form-control @error('user_type') is-invalid @enderror" name="user_type" value="{{ old('user_type') }}" required autocomplete="user_type">
                                                    <option> Selecione </option>
                                                    @foreach($medicos as $key => $medico)
                                                        <option value="{{ $medico['id'] }}" <?php if($agendamento['id_medico'] == $medico['id']) echo 'selected'; ?>> 
                                                            {{ $medico['nome'] }}
                                                        </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Paciente</label>
                                                    <select name="paciente" id="paciente" class="form-control @error('user_type') is-invalid @enderror" required>
                                                    <option> Selecione </option>
                                                    @foreach($pacientes as $key => $paciente)
                                                        <option value="{{ $paciente['id'] }}" <?php if($agendamento['id_paciente'] == $paciente['id']) echo 'selected'; ?>>
                                                            {{ $paciente['nome'] }} 
                                                        </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 pr-1">
                                                <div class="form-group">
                                                    <label>Horário</label>
                                                    <input type="text" class="form-control" id="horario" name="horario" placeholder="Horario">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Salvar Agendamento</button>
                                        <div class="clearfix"></div>
                                    </form>
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
    var start   = ($('input[name="horario_inicio"]').val() != "") ? $('input[name="horario_inicio"]').val() : moment().startOf('hour');
    var end     = ($('input[name="horario_fim"]').val() != "") ? $('input[name="horario_fim"]').val() : moment().startOf('hour').add(3, 'hour');
    $('input[name="horario"]').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        startDate: start,
        endDate: end,
        locale: {
            format: 'DD/MM/YYYY HH:MM',
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancel",
            fromLabel: "De",
            toLabel: "Até",
            customRangeLabel: "Custom",
            weekLabel: "Semana",
            daysOfWeek: ["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
            monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
            firstDay: 1
        },
    });
});
</script>