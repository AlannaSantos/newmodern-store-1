<!--Copiei e Colei a página product_add -->

@extends('admin.admin_master')
@section('admin')
    <!-- JQuery CDN p/ trabalhar com JS (mostrar nome subcategoria dinamicamente no select field) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="content-wrapper">
        <div class="container-full">

            <section class="content">

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title"> Editar Produto</h4>

                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col">

                                <!-- Validar os campos com POST e garantir que as imagens serão aceitas via upload, enctype -->
                                <form method="post" action=" {{ route('product.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Pega-se o id do produto específico para poder validar os dados editados -->
                                    <input type="hidden" name="id" value="{{ $products->id }}">

                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Selecionar Marca <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="brand_id" class="form-control" required="">
                                                                <option value="" selected="" disabled="">
                                                                    Selecionar Marca
                                                                </option>

                                                                <!-- Mostrar os dados da variável $brands na condição foreach (nome marca em inglês) -->
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->id }}"
                                                                        {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                                        {{ $brand->brand_name_pt }}</option>
                                                                @endforeach

                                                            </select>
                                                            @error('brand_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Selecionar Fornecedor <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="supplier_id" class="form-control" required="">
                                                                <option value="" selected="" disabled="">
                                                                    Selecionar Fornecedor
                                                                </option>


                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                        {{ $supplier->id == $products->supplier_id ? 'selected' : '' }}>
                                                                        {{ $supplier->supplier_company }}</option>
                                                                @endforeach

                                                            </select>
                                                            @error('supplier_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SELECT FIELD CATEGORIA -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Selecionar Categoria <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="category_id" class="form-control" required="">
                                                                <option value="" selected="" disabled="">
                                                                    Selecionar Categoria
                                                                </option>

                                                                <!--Mostrar os dados da variável $categories na condição foreach (nome categoria em inglês) -->
                                                                <!--CONDIÇÃO p/ mostrar os dados, passa-se a coluna category e o id da mesma: -->
                                                                <!--Quando os IDs combinarem, a fk_id category com o produto, então mostra-se -->
                                                                <!--Dinamicamente, a categoria cadastrada p/ aquele produto -->
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ $category->id == $products->category_id ? 'selected' : '' }}>
                                                                        {{ $category->category_name_pt }}</option>
                                                                @endforeach

                                                            </select>
                                                            @error('category_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <!-- SELECT FIELD SUB CATEGORIA -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Selecionar Sub-Categoria <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="subcategory_id" class="form-control"
                                                                required="">
                                                                <option value="" selected="" disabled="">
                                                                    Selecionar
                                                                    Categoria
                                                                </option>

                                                                <!--Mostrar os dados da variável $subcategories na condição foreach (nome subcategoria em inglês) -->
                                                                <!--CONDIÇÃO p/ mostrar os dados, passa-se a coluna subcategory e o id da mesma: -->
                                                                <!--Quando os IDs combinarem, a fk_id subcategory com o produto, então mostra-se -->
                                                                <!--dinamicamente, a categoria cadastrada p/ aquele produto -->
                                                                @foreach ($subcategories as $subcategory)
                                                                    <option value="{{ $subcategory->id }}"
                                                                        {{ $subcategory->id == $products->subcategory_id ? 'selected' : '' }}>
                                                                        {{ $subcategory->subcategory_name_pt }}</option>
                                                                @endforeach


                                                            </select>
                                                            @error('subcategory_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SELECT FIELD SUB-SUB-CATEGORIA -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Selecionar Sub-Sub-Categoria <span class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select name="subsubcategory_id" class="form-control"
                                                                required="">
                                                                <option value="" selected="" disabled="">
                                                                    Selecionar Sub Sub Categoria
                                                                </option>

                                                                {{-- <!--Mostrar os dados da variável $subsubcategories na condição foreach (nome subsubcategoria em inglês)-->
                                                                <!--CONDIÇÃO p/ mostrar os dados, passa-se a coluna subsubcategory e o id da mesma: -->
                                                                <!--Quando os IDs combinarem, a fk_id subsubcategory com o produto, então mostra-se -->
                                                                <!--Dinamicamente, a categoria cadastrada p/ aquele produto --> --}}
                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <option value="{{ $subsubcategory->id }}"
                                                                        {{ $subsubcategory->id == $products->subsubcategory_id ? 'selected' : '' }}>
                                                                        {{ $subsubcategory->subsubcategory_name_pt }}
                                                                    </option>
                                                                @endforeach


                                                            </select>
                                                            @error('subsubcategory_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- INPUT FIELD NOME PRODUTO PORTUGUÊS -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Nome Produto <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_name_pt"
                                                                class="form-control" required=""
                                                                value="{{ $products->product_name_pt }}">


                                                            @error('product_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <!-- INPUT FIELD CÓDIGO DO PRODUTO-->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Código <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_code" class="form-control"
                                                                required="" value="{{ $products->product_code }}">

                                                            @error('product_code')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- INPUT FIELD QUANTIDADE PRODUTO-->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Quantidade <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_qty" class="form-control"
                                                                required="" value="{{ $products->product_qty }}">

                                                            @error('product_qty')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- INPUT FIELD VALOR VENDA -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Valor Venda <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_selling_price"
                                                                class="form-control" required=""
                                                                value="{{ $products->product_selling_price }}">

                                                            @error('product_selling_price')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- INPUT FIELD INSERIR VALOR DESCONTO-->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Valor Final com Desconto <span
                                                                class="text-info">Opcional</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_discount_price"
                                                                class="form-control"
                                                                value="{{ $products->product_discount_price }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- INSERIR COR PORTUGUÊS-->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Cor <span class="text-info">OPCIONAL</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_color_pt"
                                                                class="form-control" value="" data-role="tagsinput"
                                                                value="{{ $products->product_color_pt }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- TAMANHO PRODUTO PORTUGUÊS -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5> Tamanho <span class="text-info">Opcional</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="product_size_pt"
                                                                class="form-control" value="" data-role="tagsinput"
                                                                value="{{ $products->product_size_pt }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br><br>


                                            <div class="row">

                                                <!-- TEXT-AREA DESCRIÇÃO CURTA PTBR -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Descrição Curta <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea name="product_short_description_pt" id="product_short_description_pt" class="form-control"
                                                                placeholder="Insira a Descrição Curta do Produto"></textarea>
                                                            {!! $products->product_short_description_pt !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br><br>

                                            <div class="row">


                                                <!-- TEXT-AREA DESCRIÇÃO LONGA PTBR -->
                                                <!-- CK EDITOR FOI UTILIZADO PARA DESCRIÇÃO LONGA TIRADO DE **forms_editor.html** DO PACOTE TEMPLATE COMPRADO -->
                                                <!-- É possível criar mais editores CK adicionando novas funções no editor.js localizado em /public/backend/pages/editor.js -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Descrição Longa <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea id="editorPTBR" name="product_long_description_pt" rows="10" cols="80">
                                                                {!! $products->product_long_description_pt !!}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>

                                            <!-- ========= TRABALHO FUTURO LUCAS ========= -->
                                            {{-- <div class="row">
                                                <!-- CHECKBOX 1 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5> PROMOÇÕES (OPCIONAL) </h5>
                                                        <div class="controls">
                                                            <fieldset>

                                                                {{-- Valor 1 significa que ao selecinar esse checkbox, o produto terá essa oferta
                                                                    e aparecerá no campo específico no frontend cliente --}}

                                            {{-- <input type="checkbox" id="checkbox_2"
                                                                    name="product_hot_deals" value="1">
                                                                <label for="checkbox_2">Hot Deals</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                <input type="checkbox" id="checkbox_3"
                                                                    name="product_featured" value="1">
                                                                <label for="checkbox_3">Featured/Destaque</label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                            <!-- CHECKBOX 2 -->
                                            {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>PROMOÇÕES (OPCIONAL) </h5>
                                                        <div class="controls">
                                                            <fieldset>
                                                                {{-- Valor 1 significa que ao selecinar esse checkbox, o produto terá essa oferta
                                                                e aparecerá no campo específico no frontend cliente --}}
                                            {{-- <input type="checkbox" id="checkbox_4"
                                                                    name="product_special_offer" value="1">
                                                                <label for="checkbox_4">Especial Offer</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                <input type="checkbox" id="checkbox_5"
                                                                    name="product_special_deals" value="1">
                                                                <label for="checkbox_5">Especial Deals</label>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <!-- =============== BOTÃO ADICIONAR PRODUTO  ================ -->
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                    value="Adicionar">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        </section>


        <!-- ============================ EDITAR IMAGENS PRODUTO ========================== -->

        <section class="content">
            <div class="row">
                <!-- Card exemplo tirado do template card-color.html -->
                <div class="col-md-12">
                    <div class="box bt-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Atualizar <strong>Imagens</strong></h4>
                        </div>

                    </div>

                    <!-- formulário com método POST para atualizar as imagens produto -->
                    <form method="post" action="{{ route('product.update.image') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- classe div pequena -->
                        <div class="row row-sm">

                            <!-- loop condicional percorrer -->
                            @foreach ($images as $image)
                                <div class="col-md-3">

                                    <!-- card tirado do site oficial do Bootstrap em componentes/cards. -->
                                    <div class="card">
                                        <img src="{{ asset($image->photo_name) }}" class="card-img-top"
                                            style="height: 300px; width: 280px;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('product.delete.image', $image->id) }}"
                                                    class="btn btn-sm btn-danger" id="delete"
                                                    title="Excluir Imagens"><i class="fa fa-trash"></i> </a>
                                            </h5>
                                            <p class="card-text">
                                            <div class="form-group">
                                                <!-- BootStrap class -->
                                                <label class="form-control-label">Mudar Imagem <span
                                                        class="tx-danger">*</span></label>
                                                <!-- acessar as imagens com a id da mesma -->
                                                <input class="form-control" type="file"
                                                    name="images[{{ $image->id }}]">
                                            </div>
                                            </p>

                                        </div>
                                    </div>

                                </div>
                            @endforeach

                            
                </div>

                <!-- Botão update imagem, classe do botão é referente ao tema do projeto, (sunny admin) -->
                <div class="text-xs-right">
                    <input type="submit" class="btn btn-rounded btn-success mb-5" value="Atualizar Imagens">
                </div>

                <br>
                <br>

                </form>
        </section>


        <!-- ============================ EDITAR THUMBNAIL PRODUTO ========================== -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box bt-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Atualizar <strong>Thumbnail</strong></h4>
                        </div>

                    </div>

                    <!-- formulário com método POST para atualizar as imagens produto -->
                    <form method="post" action="{{ route('product.update.thumbnail') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $products->id }}">

                        <input type="hidden" name="old_image" value="{{ $products->product_thumbnail }}">

                        <div class="row row-sm">
                            <div class="col-md-3">

                                <div class="card">
                                    <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top"
                                        style="height: 200px; width: 280px;">
                                    <div class="card-body">


                                        </h5>
                                        <p class="card-text">
                                        <div class="form-group">
                                            <!-- BootStrap class p/ exibir cartões -->
                                            <label class="form-control-label">Mudar Thumbnail <span
                                                    class="tx-danger">*</span></label>
                                            <!-- acessar as imagens com a id da mesma -->
                                            <input type="file" name="product_thumbnail" class="form-control"
                                                onchange="thumbnailURL(this)">
                                        </div>
                                        <img src="" id="thumbnailURL">
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botão update imagem, classe do botão é referente ao tema do projeto, (sunny admin) -->
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-success mb-5" value="Atualizar Thumbnail">
                        </div>

                        <br>
                        <br>

                    </form>
                </div>
            </div>
        </section>

        <!-- Código JS para mostrar nome subcategoria dinamicamente -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="category_id"]').on('change', function() {
                    var category_id = $(this).val();
                    if (category_id) {
                        $.ajax({
                            url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="subsubcategory_id"]').html(
                                    ''
                                ); // Ao mudar a categoria no selectview, o campo sub-sub-categoria torna-se nulo
                                var d = $('select[name="subcategory_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="subcategory_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .subcategory_name_pt + '</option>');
                                });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });

                // Código JS para mostrar nome sub-sub0categoria dinamicamente no select field ao selecionar a sub-categoria 
                $('select[name="subcategory_id"]').on('change', function() {
                    var subcategory_id = $(this).val();
                    if (subcategory_id) {
                        $.ajax({
                            url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var d = $('select[name="subsubcategory_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="subsubcategory_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .subsubcategory_name_pt + '</option>');
                                });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });

            });
        </script>


        {{-- Código JS p/ mostrar imagem Thumbnail pela função JS onChange
            Pega somente um index, ou seja, apenas uma imagem --}}

        <script type="text/javascript">
            // Chamar a função declarada na div thumbnail e passar o input
            function thumbnailURL(input) {
                // Condição: se existir um arquivo, pegar o primeiro index
                if (input.files && input.files[0]) {
                    //declarar a variável (va reader) como FileReader
                    var reader = new FileReader();
                    // Onload a variável FileReader passando e na função
                    reader.onload = function(e) {
                        // Pegar a id thumbnail img e passar o atributo, (src) declarado na div thumbnail <img src="" id="thumbnail"> 
                        // e o 'e' target (e.target.result) declarando, também, a largura e a altura do thumbnail
                        $('#thumbnail').attr('src', e.target.result).width(60).height(60);

                    };
                    // Função Default do JS para ler/interpretar o primeiro index declarado na condição deste cod;
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- Código JS p/ mostrar as imagens produto pela função JS onChange -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#images').on('change', function() { //on file input change
                    if (window.File && window.FileReader && window.FileList && window
                        .Blob) // verificar API Arquivo se o mesmo é suportado pelo navegador
                    {
                        var data = $(this)[0].files; //this file data

                        $.each(data, function(index, file) { //loop em cada arquivo
                            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                    .type)) { // verifica o tipo do arquivo suportado 
                                var fRead = new FileReader(); //new filereader
                                fRead.onload = (function(file) { //trigger function on successful read
                                    return function(e) {
                                        var img = $('<img/>').addClass('thumbnail').attr(
                                                'src',
                                                e.target.result).width(60)
                                            .height(60); // cria um elemento de imagem 
                                        $('#preview_images').append(
                                            img); //append image to output element
                                    };
                                })(file);
                                fRead.readAsDataURL(file); //URL representing the file's data.
                            }
                        });

                    } else {
                        alert("O seu navegador não suporta este tipo!"); //if File API is absent
                    }
                });
            });
        </script>
    @endsection
