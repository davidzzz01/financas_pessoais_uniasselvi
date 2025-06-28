@extends('templates.app')
@section('content')
    <x-NavBar />

    <div class="container mt-5">
        <x-Painel :totalEntradaBr="$totalEntradaBr"
                  :totalSaidaBr="$totalSaidaBr"
                  :totalCor="$totalCor"
                  :totalBr="$totalBr" />

    @if (session('inserted'))
            <div class="message-box inserted">
                <p>{{ session('inserted') }}</p>
            </div>
        @endif

        @if (session('deleted'))
            <div class="message-box deleted">
                <p>{{ session('deleted') }}</p>
            </div>
        @endif

        @if (session('edited'))
            <div class="message-box edited">
                <p>{{ session('edited') }}</p>
            </div>
        @endif

        <x-Tabela :financas="$financas" />
        <button type="button" data-toggle="modal" data-target="#Modal"
            style="background-color: #439DF8; color: #031525; width: 250px; height: 60px; font-size: 18px; color:#031525FF; border-radius: 6px; border: none">Cadastrar
            nova despesa <i class="fa-light fa-plus"></i></button>
        <x-modal />

    </div>
<x-Footer/>
@endsection
