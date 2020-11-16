<div class="sidebar" data-color="red">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a class="simple-text">
                Sistema de Agendamentos
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/agendamentos') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Agendamentos</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/paciente') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Pacientes</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/medico') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Médicos</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url('/user') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Usuários</p>
                </a>
            </li>
        </ul>
    </div>
</div>