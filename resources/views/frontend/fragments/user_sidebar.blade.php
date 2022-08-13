@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
@endphp

<div class="col-md-2">
    <br>
    <img class="card-img-top" style="border-radius: 50%; width:100%"
        src="{{ !empty($user->profile_photo_path)
            ? url('upload/user_images/' . $user->profile_photo_path)
            : url('upload/no-image.png') }}"
        style=" width: 100px; height: 100px;">
    <br>
    <br>

    <ul class="list-group list-group-flush">

        <a href="{{ route('index') }}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">

            Atualizar Perfil

        </a>

        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">

            Mudar Senha

        </a>

        <a href="{{ route('my.orders') }}" class="btn btn-primary btn-sm btn-block">

            Lista Pedidos

        </a>

        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">

            Sair

        </a>
        
    </ul>
</div>
