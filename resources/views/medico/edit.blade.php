<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
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
                                    <h4 class="card-title">Médico</h4>
                                </div>
                                <div class="card-body">
                                    <form method="get" action="{{ url('medico/update/') . '/' . $medico['id'] }}">
                                    <input type="hidden" name="id_medico" value="{{ $medico['id'] }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{ $medico['nome'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>CPF/CNPJ</label>
                                                    <input type="text" class="form-control" name="cpf_cnpj" placeholder="CPF/CNPJ" value="{{ $medico['cpf_cnpj'] }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">CRM</label>
                                                    <input type="text" class="form-control" name="crm" placeholder="CRM" value="{{ $medico['crm'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-control @error('user_type') is-invalid @enderror" name="sexo" required>
                                                            <option value="Masculino" <?php if($medico['sexo'] == "Masculino") echo 'selected'; ?>> Masculino </option>
                                                            <option value="Feminino" <?php if($medico['sexo'] == "Feminino") echo 'selected'; ?>> Feminino </option>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Data Nascimento</label>
                                                    <input type="date" class="form-control" name="data_nascimento" placeholder="Data Nascimento" value="{{ $medico['data_nascimento'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Especialidades</label>
                                                    <input type="text" class="form-control" name="especialidades" placeholder="Especialidades" value="{{ $medico['especialidades'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Endereço</label>
                                                    <input type="text" class="form-control" name="endereco" placeholder="Endereço" value="{{ $medico['endereco'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="number" class="form-control" name="celular" placeholder="Celular" value="{{ $medico['celular'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Cidade</label>
                                                    <input type="text" class="form-control" name="cidade" placeholder="Cidade" value="{{ $medico['cidade'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>CEP</label>
                                                    <input type="number" class="form-control" name="cep" value="{{ $medico['cep'] }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Salvar Médico</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-image">
                                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                                </div>
                                <div class="card-body">
                                    <div class="author">
                                        <a href="#">
                                            <img class="avatar border-gray" src="{{ asset('img/faces/face-0.jpg') }}">
                                            <h5 class="title">{{ $medico['nome'] }}</h5>
                                        </a>
                                        <p class="description">
                                            {{ $medico['nome'] }}
                                        </p>
                                    </div>
                                    <p class="description text-center">
                                            CRM: {{ $medico['crm'] }}
                                        <br> Consultas Agendadas: {{ $medico['qtde_consultas'] }}
                                        <br> Pacientes Atendidos: {{ $medico['qtde_pacientes'] }}
                                    </p>
                                </div>
                                <hr>
                                <div class="button-container mr-auto ml-auto">
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-facebook-square"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-twitter"></i>
                                    </button>
                                    <button href="#" class="btn btn-simple btn-link btn-icon">
                                        <i class="fa fa-google-plus-square"></i>
                                    </button>
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
