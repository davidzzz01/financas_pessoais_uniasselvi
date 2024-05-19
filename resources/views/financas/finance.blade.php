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

    <main>
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
                    <span class="total">{{$total_br}}</span>
                </div>
            </div>

            <table class="table table-bordered mt-4 table-info">
                <thead class="custom-thead">
                <tr>
                    <th scope="col" style="background-color: #031525;color: #439DF8">ID</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Nome</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Descrição</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Valor</th>
                    <th scope="col" style="background-color: #031525;color: #439DF8">Tipo</th>
                    <th scope="col" style="width: 100px; background-color: #031525;color: #439DF8">Ações</th>
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
                            <td>{{$financa->valor}}</td>
                            <td>{{$financa->tipo}}</td>
                            <td class="d-flex">
                                <button type="button" class="btn btn-info" style="margin-right: 10px; width: 40px; height: 40px;">
                                    <i class="fa-solid fa-pencil" style="color: white; font-size: 20px;"></i>
                                </button>
                                <form action="/financas/{{$financa->id}}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-trash" style="color: white; font-size: 20px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>


            <button type="button" class="btn btn-success" style="background-color: #439DF8; color: #031525; width: 250px; height: 60px; font-size: 18px;">Cadastrar nova despesa <i class="fa-light fa-plus"></i></button>
        </div>
    </main>


@endsection
