@extends('templates.app')
@section('content')

    <nav class="navbar navbar-expand-lg " style="height: 100px; background-color: #031525; color: #439DF8;">
        <div class="container-fluid">
            <img style="width:60px;" src="https://imgs.search.brave.com/Ot_s4eRFwKT7-xYCzEM9AGH5tv20OaJj_HT5FVgHjSQ/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMudmV4ZWxzLmNv/bS9tZWRpYS91c2Vy/cy8zLzI2NjA1Ny9p/c29sYXRlZC9wcmV2/aWV3LzY1ODQ5MmYy/YzVhYjljMWNmN2Rk/NjkwMmVhZjU0OTMy/LWJpdGNvaW4tc2ln/bi1jb2luLW1vbmV5/LWljb24ucG5n">
            <a class="navbar-brand" href="#" style="color: #439DF8; font-size: 50px; margin-left: 10px;">Personal Finances</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="margin-right: 10px">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #439DF8; font-size: 18px;">Meus Gastos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: #439DF8; font-size: 18px;">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #439DF8; font-size: 18px;">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #439DF8; font-size: 18px;">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


        <div class="container mt-5">
            <div class="resume" >

                <div class="text-painel">
                    ENTRADAS: R$
                    <span class="incomes">{{$total_entrada_br}}</span>
                </div>
                <div class="text-painel">
                    SAÍDAS: R$
                    <span class="expenses">{{$total_saida_br}}</span>
                </div>
                <div class="text-painel">
                    TOTAL: R$
                    <span style='color:{{$total_cor}}' class="total">{{$total_br}}</span>
                </div>
            </div>
            @if(session('inserted'))
                <div class="message-box inserted">
                    <p>{{ session('inserted') }}</p>
                </div>
            @endif

            @if(session('deleted'))
                <div class="message-box deleted">
                    <p>{{ session('deleted') }}</p>
                </div>
            @endif

            @if(session('edited'))
                <div class="message-box edited">
                    <p>{{ session('edited') }}</p>
                </div>
            @endif

            <table class="table table-bordered mt-4 table-info">
                <thead class="custom-thead">
                <tr>
                    <th scope="col" style="background-color: #031525;color: #439DF8; width:50px">ID</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Nome</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Descrição</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8;width: 70px;">Data</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8;">Valor</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8;width: 80px">Tipo</th>
                    <th scope="col" style="width: 100px; background-color: #031525;color: #439DF8;width:40px;">Ações</th>
                </tr>
                </thead>
                <tbody>
                @if(count($financas) == 0)
                    <tr>
                        <td colspan="6" class="text-center">Ainda não há registros</td>
                    </tr>
                @else
                    @foreach($financas as $financa)
                        <tr>
                            <td>{{$financa->id}}</td>
                            <td>{{$financa->nome}}</td>
                            <td>{{$financa->descricao}}</td>
                            <td>{{ date('d/m/Y', strtotime($financa->data_despesa)); }}</td>

                            <td style="justify-content: right">{{$financa->valor_formatado}}</td>
                            <td style="color:{{$financa->class_tipo}}"> {{$financa->tipo}}</td>
                            <td class="d-flex justify-content-center align-items-center">

                                <button type="button" class="btn btn-info d-flex align-items-center justify-content-center" data-toggle="modal" data-target="#despesaModal" style="margin-right: 10px; width: 35px; height: 35px;">
                                    <i class="fa-solid fa-pencil" style="color: white; font-size: 20px;"></i>
                                </button>


                                <div class="modal fade" id="despesaModal" tabindex="-1" aria-labelledby="despesaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="despesaModalLabel">Editar Despesa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="despesaForm" method="POST" action="{{ route('financas.update', $financa->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nome">Nome</label>
                                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{$financa->nome}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="descricao">Descrição</label>
                                                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{$financa->descricao}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="data">Data</label>
                                                        <input type="date" class="form-control" id="data" name="data_despesa" value="{{$financa->data_despesa}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="valor">Valor</label>
                                                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{$financa->valor}}" step="0.01">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tipo">Tipo</label>
                                                        <select class="form-select" name="tipo">
                                                            <option value="entrada" {{$financa->tipo == 'entrada' ? 'selected' : ''}}>ENTRADA</option>
                                                            <option value="saida" {{$financa->tipo == 'saida' ? 'selected' : ''}}>SAÍDA</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <form action="/financas/{{$financa->id}}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir o registro?');" class="d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center mt-3" style="margin-right: 10px;width: 35px; height: 35px;">
                                        <i class="fa-solid fa-trash" style="color: white; font-size: 20px;"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>


            <button type="button"  data-toggle="modal" data-target="#Modal" style="background-color: #439DF8; color: #031525; width: 250px; height: 60px; font-size: 18px; color:#031525FF; border-radius: 5px; border: none">Cadastrar nova despesa <i class="fa-light fa-plus"></i></button>
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="despesaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="despesaModalLabel">Cadastrar Despesa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="despesaForm" method="POST" action="{{ route('financas.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                </div>
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                                </div>
                                <div class="form-group">
                                    <label for="data_despesa">Data</label>
                                    <input type="date" class="form-control" id="data_despesa" name="data_despesa">
                                </div>
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select class="form-select" name="tipo">
                                        <option value="entrada">ENTRADA</option>
                                        <option value="saida">SAÍDA</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>

        </div>



    <footer class="text-center mt-5" style="background-color: #031525; color: #439DF8;">
        <div class="container-fluid ">
            <p class="navbar-brand" style="color:#439DF8;">&copy; 2024 David Dantas. Todos os direitos reservados.</p>
        </div>
    </footer>
@endsection

