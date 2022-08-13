@extends('admin.admin_master')
@section('admin')
    <!-- JQuery Necessário p/ trabalhar com JavaScript Imagem -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="content-wrapper" style="min-height: 326px;">
        <div class="container-full">

            <section class="content">

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Editar Perfil Admin</h4>

                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <!--IMPORTANTE: Validar dados | Subir dados p/ BD |
                                            Rota POST  p/ admin.profile.store em /routes/web.php-->
                                <form method="post" action="{{ route('admin.profile.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!--SEGURANÇA. impede ataques CROSS SITE REQUEST FORGERY -->

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <h5>Nome Admin<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control"
                                                                required="" value="{{ $editData->name }}">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <h5>Email<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" name="email" class="form-control"
                                                                required="" value="{{ $editData->email }}">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <!-- Div campo postar imagem -->
                                                    <div class="form-group">
                                                        <h5>Foto Perfil<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="profile_photo_path"
                                                                class="form-control" required="" id="image">

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Div campo mostrar imagem -->
                                                <div class="col-md-6">
                                                    <img id="showImage"
                                                        src="{{ !empty($editData->profile_photo_path)
                                                            ? url('upload/admin_images/' . $editData->profile_photo_path)
                                                            : url('upload/no-image.png') }}"
                                                        style=" width: 100px; height: 100px;">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                    value="Update">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- javascript code para mostrar dinamicamente a foto do upload no perfil adm -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
