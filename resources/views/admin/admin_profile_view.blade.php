@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper" style="min-height: 326px;">
        <div class="container-full">

            <section class="content">
                <div class="row">

                    <div class="box box-widget widget-user">

                        <div class="widget-user-header bg-black"
                            style="background: url('../images/gallery/full/10.jpg') center center;">
                            <h3 class="widget-user-username">{{ $adminData->name }}</h3>

                            <a href="{{ route('admin.profile.edit') }}" style="float: right;"
                                class="btn btn-rounded btn-primary mb-5">
                                Editar Perfil</a>

                            <h6 class="widget-user-desc">{{ $adminData->email }}</h6>
                        </div>
                        <div class="widget-user-image">


                            {{-- IMAGE CONDITION: when it is not empty, it gets admin's photo
                            OR (?) gets images in /public/upload/admin_images
                            OR (:)loads default images located in /public/upload --}}
                            <img class="rounded-circle"
                                src="{{ !empty($adminData->profile_photo_path)
                                    ? url('upload/admin_images/' . $adminData->profile_photo_path)
                                    : url('upload/no-image.png') }}"
                                alt="User Avatar">
                        </div>

                        {{-- <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">###</h5>
                                        <span class="description-text">PENSAR EM ALGO</span>
                                    </div>

                                </div>

                                <div class="col-sm-4 br-1 bl-1">
                                    <div class="description-block">
                                        <h5 class="description-header">###</h5>
                                        <span class="description-text">DINAMICO PARA</span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">###</h5>
                                        <span class="description-text">COLOCAR AQUI</span>
                                    </div>

                                </div>

                            </div>
                        </div> --}}
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
