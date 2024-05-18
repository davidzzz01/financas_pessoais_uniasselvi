@extends('templates.app')
@section('content')

    <nav class="navbar navbar-expand-lg bg-dark" style="height: 100px;">
        <div class="container-fluid">
            <img  style="width:60px;"src="https://imgs.search.brave.com/Ot_s4eRFwKT7-xYCzEM9AGH5tv20OaJj_HT5FVgHjSQ/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMudmV4ZWxzLmNv/bS9tZWRpYS91c2Vy/cy8zLzI2NjA1Ny9p/c29sYXRlZC9wcmV2/aWV3LzY1ODQ5MmYy/YzVhYjljMWNmN2Rk/NjkwMmVhZjU0OTMy/LWJpdGNvaW4tc2ln/bi1jb2luLW1vbmV5/LWljb24ucG5n">
            <a class="navbar-brand" href="#" style="color: white; font-size: 50px;margin-left: 10px">  Personal Finances</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="margin-right: 10px">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;  font-size: 18px"> Meus Gastos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" style="color: white;font-size: 18px"> Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;font-size: 18px">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;font-size: 18px">Contato</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


<div class="container mt-5">
    <div class="resume">
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


        <table class="table table-dark table-striped-columns mt-4">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Tipo</th>
                <th scope="col" style="width: 100px">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($financas as $financa)
                <th scope="row">{{$financa->id}}</th>
                <td>{{$financa->nome}}</td>
                <td>{{$financa->descricao}}</td>
                <td>{{$financa->valor}}</td>
                <td>{{$financa->tipo}}</td>
                    <td style="display: flex;"><button type="button" class="btn btn-info " style=" margin-right: 10px;"><i class="fa-solid fa-pencil"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </td>

            </tr>
    @endforeach
            </tbody>
        </table>
            <div> <button type="button" class="btn btn-success" style="width: 250px; height: 60px;font-size: 18px;">Cadastrar nova despesa <i class="fa-light fa-plus"></i></button></div>
</div>
@endsection
