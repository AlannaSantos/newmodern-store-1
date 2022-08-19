@extends('frontend.main_master')
@section('content')

@section('title')
    NewModern | Home
@endsection
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ======= MENU VERTICAL CATEGORIAS =========== -->
                @include('frontend.fragments.vertical_menu')

            </div>



            <!-- =================== CONTENT ======================= -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">



                <!-- ==================== INFO BOXES =================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">EM BREVE</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Cupons de desconto. Fique ligado!</h6>
                                </div>
                            </div>


                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Envio</h4>
                                        </div>
                                    </div>
                                    <h6 class="text"> Grátis em território Paranaense</h6>
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">LEIA!</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">A Metamorfose - Franz Kafka </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- =========================== SCROLL TABS NOVOS PRODUTOS - HOME ============================== -->

                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">

                            Novos Produtos

                        </h3>

                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">

                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">

                                    Todos

                                </a></li>

                            <!-- loop condicional para 'baixar' os dados categoria na index.home -->
                            @foreach ($categories as $category)
                                <li><a data-transition-type="backSlide" href="#category{{ $category->id }}"
                                        data-toggle="tab">

                                        {{ $category->category_name_pt }}

                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="tab-content outer-top-xs">

                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                                    <!-- loop condicional para percorrer os dados produto categorizado na index.home -->
                                    @foreach ($products as $product)
                                        <div class="item item-carousel">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <!-- url para acessar detalhes do produto ao clickar na imagem produto -->
                                                            <a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">
                                                                <!-- mostrar miniatura produto dinamicamente em 'novos produtos' -->
                                                                <img src="{{ asset($product->product_thumbnail) }}"
                                                                    alt="">
                                                            </a>
                                                        </div>


                                                        <!-- Lógica porcentagem -->
                                                        @php
                                                            $discount = $product->product_selling_price - $product->product_discount_price;
                                                            $percentage = ($discount / $product->product_selling_price) * 100;
                                                        @endphp

                                                        <div>
                                                            <!-- Lógica: se não houver desconto, aparecer a a tag new...-->
                                                            @if ($product->product_discount_price == null)
                                                                <div class="tag new"><span>

                                                                        NOVO

                                                                    </span></div>
                                                            @else
                                                                <!-- caso contrário, mostrar a porcentagem de desconto -->
                                                                <div class="tag hot">
                                                                    <span>{{ round($percentage) }} %</span>
                                                                </div>
                                                            @endif
                                                        </div>



                                                    </div>


                                                    <!-- =============== DETALHES DO PRODUTO COMEÇA AQUI" =================== -->

                                                    <div class="product-info text-left">
                                                        <!-- url: ao clickar em um produto específico, redirencianar para a página detalahe do produto -->
                                                        <h3 class="name"><a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">

                                                                {{ $product->product_name_pt }}

                                                            </a>
                                                        </h3>
                                                        {{-- NOTA DE AVALIAÇÃO DO PRODUTO | PROJETO FUTURO --}}
                                                        {{-- <div class="rating rateit-small"></div> --}}
                                                        <div class="description"></div>

                                                        <!--== LÓGICA P/ MOSTRAR VALOR PRODUTO DINAMICAMENTE ==-->

                                                        <!-- Lógica: se não houver desconto, aparecer o valor normal (product_selling_price)...-->
                                                        @if ($product->product_discount_price == null)
                                                            <div class="product-price"> <span class="price">
                                                                    R$ {{ $product->product_selling_price }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <!-- caso contrário, mostrar valor com o desconto -->
                                                            <div class="product-price"> <span class="price">
                                                                    R$ {{ $product->product_discount_price }}
                                                                </span><span class="price-before-discount">
                                                                    R$ {{ $product->product_selling_price }}
                                                                </span>
                                                            </div>
                                                        @endif

                                                    </div>

                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">


                                                                    <!-- Modal Bootstrap Button -->
                                                                    <button class="btn btn-primary icon" type="button"
                                                                        title="Add Cart" data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        id="{{ $product->id }}"
                                                                        onclick="productView(this.id)"> <i
                                                                            class="fa fa-shopping-cart"></i>
                                                                    </button>

                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">

                                                                        Adicionar

                                                                    </button>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!--======================================== NOVOS PRODUTOS ============================================ -->
                        @foreach ($categories as $category)
                            <div class="tab-pane" id="category{{ $category->id }}">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme"
                                        data-item="4">

                                        <!-- buscar os produtos por suas respectivas categorias -->
                                        @php
                                            $categorised_product = App\Models\Product::where('category_id', $category->id)
                                                ->orderBy('id', 'DESC')
                                                ->get();
                                        @endphp


                                        <!-- loop condicional para 'baixar' os dados produto por categoria na index.home -->
                                        @forelse ($categorised_product as $product)
                                            <div class="item item-carousel">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <!-- url para redirecionar para pagina detalhes produto ao clickar na imagem -->
                                                                <a
                                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">
                                                                    <!-- mostrar miniatura produto dinamicamente em 'novos produtos' -->
                                                                    <img src="{{ asset($product->product_thumbnail) }}"
                                                                        alt="">
                                                                </a>
                                                            </div>

                                                            <!-- Lógica porcentagem -->
                                                            @php
                                                                $discount = $product->product_selling_price - $product->product_discount_price;
                                                                $percentage = ($discount / $product->product_selling_price) * 100;
                                                            @endphp

                                                            <div>
                                                                <!-- Lógica: se não houver desconto, aparecer a a tag new...-->
                                                                @if ($product->product_discount_price == null)
                                                                    <div class="tag new"><span>

                                                                            NOVO

                                                                        </span></div>
                                                                @else
                                                                    <!-- caso contrário, mostrar a porcentagem de desconto -->
                                                                    <div class="tag hot">
                                                                        <span>{{ round($percentage) }} %</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>


                                                        <div class="product-info text-left">
                                                            <h3 class="name">
                                                                <!-- url para redirecionar para pagina detalhes produto ao clickar no nome produto -->
                                                                <a
                                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">

                                                                    {{ $product->product_name_pt }}

                                                                </a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description"></div>

                                                            <!--== LÓGICA P/ MOSTRAR VALOR PRODUTO DINAMICAMENTE ==-->

                                                            <!-- Lógica: se não houver desconto, aparecer o valor normal (product_selling_price)...-->
                                                            @if ($product->product_discount_price == null)
                                                                <div class="product-price"> <span class="price">
                                                                        R$ {{ $product->product_selling_price }}
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <!-- caso contrário, mostrar valor com o desconto -->
                                                                <div class="product-price"> <span class="price">
                                                                        R$ {{ $product->product_discount_price }}
                                                                    </span><span class="price-before-discount">
                                                                        R$ {{ $product->product_selling_price }}
                                                                    </span>
                                                                </div>
                                                            @endif

                                                        </div>

                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">

                                                                        <!-- Modal Bootstrap Button -->
                                                                        <button class="btn btn-primary icon"
                                                                            type="button" title="Add Cart"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModal"
                                                                            id="{{ $product->id }}"
                                                                            onclick="productView(this.id)"> <i
                                                                                class="fa fa-shopping-cart"></i>
                                                                        </button>

                                                                        <button class="btn btn-primary cart-btn"
                                                                            type="button">

                                                                            Adicionar

                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <h5 class="text-danger">

                                                Categoria sem Produtos

                                            </h5>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================== BRANDS CAROUSEL PROJETO FUTURO ============================================== -->
        {{-- @include('frontend.body.brands') --}}

    </div>
</div>

@endsection
