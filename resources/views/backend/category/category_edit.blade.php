@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper" style="min-height: 326px;">
        <div class="container-full">

            <section class="content">
                <div class="row">


                    <!--  =============== EDITAR CATEGORIA ================ -->

                    <div class="col-12">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Atualizar Categoria </h3>
                            </div>
                           
                            <div class="box-body">
                                <div class="table-responsive">

                                    {{-- foi criado uma rota POST para guardar a atualização Category 
                                        passa p/ rota category.update com a ID da mesma --}}
                                    <form method="post" action="{{ route('category.update', $category->id) }}">
                                        @csrf

                                         {{-- incluir dados que não podem ser vistos ou modificados pelos usuários 
                                                    quando um formulário é enviado  --}}
                                        <input type="hidden" name="id" value="{{ $category->id }}" >

                                        <!-- SE QUISERMOS TRABALHAR COM IMAGEM AO INVÉS DE ÍCONE -->
                                             {{-- POST image update
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                             POST method: pegar a imagem antiga
                                            <input type="hidden" name="old_image" value="{{ $category->category_image }}"> --}}
                                             

                                        <!-- INPUT FIELD P/ CATEGORIA PTBR -->
                                        <div class="form-group">
                                            <h5> Categoria <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="category_name_pt" class="form-control"
                                                    value="{{ $category->category_name_pt }}">
                                                <!-- Mostrar nome marca dinamicamente -->

                                                @error('category_name_pt')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                
                                            </div>

                                        </div>



                                        <!--SE QUISERMOS TRABALHAR COM IMAGEM -->
                                        
                                            {{-- <div class="form-group">
                                                <h5>Imagem <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="category_image" class="form-control">
                                                    @error('category_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                           

                                       
                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                value="Atualizar">
                                        </div>
                                    </form>

                                </div>
                            </div>                           
                        </div>                       
                    </div>                   
                </div>
            </section>
        </div>
    </div>
@endsection
