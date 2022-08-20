@extends('frontend.main_master')
@section('content')

@section('title')
    {{ $product->product_name_pt }} Detalhes
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Descrição</li>
            </ul>
        </div>
    </div>
</div>


<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-3 sidebar'>


                <div class="sidebar-module-container">

                    {{-- PLACE HOLDER --}}

                </div>
            </div>
            <!-- ========= IMAGENS PRODUTOS COMEÇA AQUI =========== -->
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <!-- Pegar a relaação de produtos com imagens e mostrar aqui -->
                                    @foreach ($images as $image)
                                        <div class="single-product-gallery-item" id="slide{{ $image->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                                href="{{ asset($image->photo_name) }}">
                                                <img class="img-responsive" alt=""
                                                    src="{{ asset($image->photo_name) }}"
                                                    data-echo="{{ asset($image->photo_name) }}" />
                                            </a>
                                        </div>
                                    @endforeach

                                </div>

                                <!-- ============== THUMBNAILS PRODUTOS COMEÇA AQUI ============ -->
                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">

                                        <!-- Pegar a relaação de produtos com imagens e mostrar aqui -->
                                        @foreach ($images as $image)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                    data-slide="1" href="#slide{{ $image->id }}">
                                                    <img class="img-responsive" width="85" alt=""
                                                        src="{{ asset($image->photo_name) }}"
                                                        data-echo="{{ asset($image->photo_name) }}" />
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ============================= DADOS PRODUTO AQUI ======================== -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <!-- ================ NOME AQUI =================-->
                                <h1 class="name" id="pname">

                                    {{ $product->product_name_pt }}

                                </h1>


                                <!-- ================ DISPONIBILIDADE AQUI =================-->
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Situação :</span>
                                            </div>
                                        </div>

                                        <!-- ================ ESTOQUE AQUI =================-->
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">Disponível</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ================ DESCRIÇÃO CURTA AQUI =================-->
                                <div class="description-container m-t-20">

                                    {{ $product->product_short_description_pt }}

                                </div>

                                <!-- ================ PREÇO AQUI =================-->
                                <div class="price-container info-container m-t-20">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="price-box">

                                                <!-- se o campo desconto descont estiver nulo, mostrar apenas a classe "price" -->
                                                @if ($product->product_discount_price == null)
                                                    <span class="price">R$
                                                        {{ $product->product_selling_price }}</span>
                                                @else
                                                    <!-- caso contrário, mostrar os campos strike e preço depois do desconto -->
                                                    <span class="price">R$
                                                        {{ $product->product_discount_price }}</span>
                                                    <span class="price-strike">R$
                                                        {{ $product->product_selling_price }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ================ COR AQUI =================-->
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{-- BOOTSTRAP TIRADO DE shopping-cart.html Flipmart Template --}}
                                        {{-- Condição &&: se a cor do produto ingles e portugues forem nulos, então não mostrar selectform, caso contrário, mostrar --}}
                                        <div class="form-group">
                                            @if ($product->product_color_pt == null)
                                            @else
                                                <label class="info-title control-label">

                                                    Escolher Cor
                                                    <span>*</span>
                                                </label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    id="color">
                                                    <option selected="" disabled="" required=""> Escolher Cor
                                                    </option>

                                                    {{-- função ucwords() padroniza palvras, assim o mantendeor 
                                                    não precisa se procupar em digitar Maniusculas ou Minusculas --}}
                                                    @foreach ($product_color_pt as $cor)
                                                        <option value="{{ $cor }}">{{ ucwords($cor) }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            @endif
                                        </div>

                                    </div>


                                    <!-- ================ TAMANHO COMEÇA AQUI =================-->
                                    <div class="col-sm-6">
                                        {{-- BOOTSTRAP TIRADO DE shopping-cart.html Flipmart Template --}}

                                        {{-- <!-- condição if-else: tamanho protuo ingles e portugues forem nulos, 
                                            não mostrar campo tamanho na descrição do produto, caso contrário, seguir normalmente. --> --}}
                                        <div class="form-group">
                                            @if ($product->product_size_pt == null)
                                            @else
                                                <label class="info-title control-label">Escolher
                                                    Tamanho<span></span></label>

                                                <select class="form-control unicase-form-control selectpicker"
                                                    id="size">
                                                    <option selected="" disabled="" required="">Escolher
                                                        Tamanho</option>

                                                    {{-- função ucwords() padroniza palvras, assim o mantendeor 
                                                    não precisa se procupar em digitar Maniusculas ou Minusculas --}}

                                                    @foreach ($product_size_pt as $tamanho)
                                                        <option value="{{ $tamanho }}">
                                                            {{ ucwords($tamanho) }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- =========== ADD TO CART COM QUANTIDADE ESPECÍFICA  =========-->
                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">

                                                    Quantida...

                                                </span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{-- DEIXAR 'ARROWS' INCREMENTAR - DECREMENTAR, FUNCIONAL --}}
                                                        {{-- <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div> --}}

                                                        <input type="text" id="qty" value="1"
                                                            min="1">

                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}"
                                                min="1">


                                            <div class="col-sm-7">

                                                <button type="submit" onclick="addToCart()" class="btn btn-primary"><i
                                                        class="fa fa-shopping-cart inner-right-vs"></i>

                                                    Adicionar

                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">

                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <!-- ================ DESCRIÇÃO LONGA AQUI =================-->
                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">

                                                <!-- Sintaxe blade (!!) para evitar mostrar código HTML no frontend -->
                                                {!! $product->product_long_description_pt !!}

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="clearfix"></div>
        </div>
    </div>
    <hr>

    {{-- @include('frontend.body.brands') --}}
@endsection
