@extends('frontend.main_master')
@section('content')
    <!-- Query Builder -->
    {{-- Desenvolvido à partir do Database Access Objects, o query builder permite que você construa 
    uma instrução SQL em um programático e independente de banco de dados. Comparado a escrever 
    instruções SQL à mão, usar query builder lhe ajudará a escrever um código SQL relacional mais 
    legível e gerar declarações SQL mais seguras. --}}
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
                    <!-- PLACEHOLDER: se tirar, bagunça o layout -->
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">
                               
                                Mudar Senha
                               
                            </span><strong>
                            </strong></h3>

                        <div class="card-body">
                            <form method="post" action="{{ route('user.password.update') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">
                                       
                                        Senha Atual
                                      
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" id="current_password" name="oldpassword"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">
                                        
                                        Nova Senha
                                       
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" id="password" name="password"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">
                                        
                                        Confirmar
                                     
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                       
                                        Atualizar
                                       
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
