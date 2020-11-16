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
                                    <h4 class="card-title">Perfil</h4>
                                </div>
                                <div class="card-body">
                                    <form method="get" action="{{ url('user/update/') . '/' . $usuario['id'] }}">
                                    <input type="hidden" name="user_id" value="{{ $usuario['id'] }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Nome" value="{{ $usuario['name'] }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Tipo Acesso</label>
                                                    <input type="text" class="form-control" name="user_type" placeholder="Tipo" value="{{ $usuario['user_type'] }}" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $usuario['email'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Endereço</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Endereço" value="{{ $usuario['address'] }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Cidade</label>
                                                    <input type="text" class="form-control" name="city" placeholder="Cidade" value="{{ $usuario['city'] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>CEP</label>
                                                    <input type="number" class="form-control" name="zip_code" value="{{ $usuario['zip_code'] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Senha-Preencha para Alterar</label>
                                                    <input type="password" class="form-control" name="password" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Atualizar Perfil</button>
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
                                            <h5 class="title">{{ $usuario['name'] }}</h5>
                                        </a>
                                        <p class="description">
                                            {{ $usuario['name'] }}
                                        </p>
                                    </div>
                                    <p class="description text-center">
                                        "Lorem ipsum dolor sit amet,
                                        <br> consectetur adipiscing elit.
                                        <br> Aliquam id elementum arcu. Phasellus."
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