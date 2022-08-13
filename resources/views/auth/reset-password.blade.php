<!-- Extender main_master localizado em views/frontend (fragmentação frontend) -->
@extends('frontend.main_master')
@section('content')
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class="active">Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->

    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Recuperação de Senha</h4>
                    <p class="">Esqueceu sua senha? Basta criar uma senha nova.</p>

                    <!-- UPDATE DE SENHA-->
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label class="info-title" for="exampleInputpassword1">Email <span>*</span></label>
                            <input type="email" id="email" name="email"
                                class="form-control unicase-form-control text-input">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputpassword1">Senha <span>*</span></label>
                            <input type="password" id="password" name="password"
                                class="form-control unicase-form-control text-input">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputpassword1">Confirmar Senha <span>*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control unicase-form-control text-input">
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Redefinir
                            Senha</button>
                    </form>
                </div>


            </div>
        </div>

        <!-- INCLUSÃO DAS LOGOMARCAS -->
        {{-- @include('frontend.body.brands') --}}
    @endsection
