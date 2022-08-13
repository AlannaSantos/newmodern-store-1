<!-- Extender main_master localizado em views/frontend (fragmentação frontend) -->
@extends('frontend.main_master')
@section('content')
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class="active">Recuperação Senha</li>
            </ul>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Recuperar Senha</h4>
                    <p class="">Esqueceu sua senha? Sem problemas!</p>

                    <!-- RECUPERAÇÃO DE SENHA VIA EMAIL-->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="exampleInputpassword1">Insira seu Email <span
                                    class="danger">*</span></label>
                            <input type="email" id="email" name="email"
                                class="form-control unicase-form-control text-input">
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Recuperar Senha via
                            Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- INCLUSÃO DAS LOGOMARCAS -->
    {{-- @include('frontend.body.brands') --}}
@endsection
