@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('frontend.fragments.user_sidebar')

                <div class="col-md-2">
                    {{-- LAYOUT PLACEHOLDER --}}
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">

                                Olá...

                            </span><strong>
                                {{ Auth::user()->name }}</strong>

                            Você pode editar
                            o seu perfil aqui.

                        </h3>

                        <div class="card-body">
                            <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">

                                        Nome

                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">

                                        Telefone

                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                                        class="form-control unicase-form-control text-input">
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="exampleInputemail1">

                                        Foto Perfil

                                        <span class="text-info">OPCIONAL</span>
                                    </label>
                                    <input type="file" id="" name="profile_photo_path"
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
