@extends('frontend.main_master')
@section('content')

    {{-- Query Builder (construtor de Consulta) Desenvolvido à partir do Database Access Objects, 
    o query builder permite que você construa uma instrução SQL em um programático e independente 
    de banco de dados. Comparado a escrever instruções SQL à mão, usar query builder lhe ajudará a 
    escrever um código SQL relacional mais legível e gerar declarações SQL mais seguras. --}}
    @php
    $user = DB::table('users')
        ->where('id', Auth::user()->id)
        ->first();
    @endphp

    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('frontend.fragments.user_sidebar')

                <div class="col-md-2">

                    {{-- LAYOUT PLACE HOLDER --}}

                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">

                                Olá!

                            </span><strong>
                                {{ Auth::user()->name }}</strong>
                            <hr>

                            Bem-vindo à NewModern Ecommerce

                        </h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
