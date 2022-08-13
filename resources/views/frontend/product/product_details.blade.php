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

                    <!-- ============ BANNER ============ -->
                    {{-- <div class="home-banner outer-top-n">
                        <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                    </div> --}}



                    <!-- ============================================== HOT DEALS FRAGMENT ============================================== -->

                    {{-- @include('frontend.fragments.hot_deals') --}}

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

                                <!-- ================ AVALIAÇÃO AQUI =================-->
                                {{-- <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(13 Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div> --}}

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

                                        <!-- ================ BOTÃO WISHLIST AQUI =================-->
                                        {{-- <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Add to Compare" href="#">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="E-mail" href="#">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div> --}}

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
                                                    <option selected="" disabled=""> Escolher Cor </option>

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
                                                    <option selected="" disabled="">Escolher Tamanho</option>

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

                                                    Quant...

                                                </span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
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
                            <!-- ================ REVIEWS PRODUTO =================-->
                            {{-- <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                                </ul>
                            </div> --}}

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

                                    <!-- ========== AVALIAÇÕES ========= -->
                                    {{-- <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary">We love this
                                                                product</span><span class="date"><i
                                                                    class="fa fa-calendar"></i><span>1 days
                                                                    ago</span></span></div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit.Aliquam suscipit."</div>
                                                    </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->



                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-label">&nbsp;</th>
                                                                    <th>1 star</th>
                                                                    <th>2 stars</th>
                                                                    <th>3 stars</th>
                                                                    <th>4 stars</th>
                                                                    <th>5 stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-label">Quality</td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="5"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="cell-label">Price</td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="5"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="cell-label">Value</td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="1"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="2"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="3"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="4"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio" value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table><!-- /.table .table-bordered -->
                                                    </div><!-- /.table-responsive -->
                                                </div><!-- /.review-table -->

                                                <div class="review-form">
                                                    <div class="form-container">
                                                        <form role="form" class="cnt-form">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Your Name <span
                                                                                class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                            id="exampleInputName" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                    <div class="form-group">
                                                                        <label for="exampleInputSummary">Summary <span
                                                                                class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                            id="exampleInputSummary" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputReview">Review <span
                                                                                class="astk">*</span></label>
                                                                        <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                                    </div><!-- /.form-group -->
                                                                </div>
                                                            </div><!-- /.row -->

                                                            <div class="action text-right">
                                                                <button class="btn btn-primary btn-upper">SUBMIT
                                                                    REVIEW</button>
                                                            </div><!-- /.action -->

                                                        </form><!-- /.cnt-form -->
                                                    </div><!-- /.form-container -->
                                                </div><!-- /.review-form -->

                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div> --}}

                                    <!-- ========== TAGS ========= -->
                                    {{-- <div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">

                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag"
                                                            class="form-control txt">


                                                    </div>

                                                    <button class="btn btn-upper btn-primary" type="submit">ADD
                                                        TAGS</button>
                                                </div><!-- /.form-container -->
                                            </form><!-- /.form-cnt -->

                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                        single quotes (') for phrases.</span>
                                                </div>
                                            </form><!-- /.form-cnt -->

                                        </div><!-- /.product-tab -->
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== PRODUTOS RELACIONADOS ============================================== -->
                    {{-- <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">

                            Produtos Relacionados

                        </h3>
                        <div
                            class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                            @foreach ($related as $product)
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
                                                            {{ $product->product_selling_price }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <!-- caso contrário, mostrar valor com o desconto -->
                                                    <div class="product-price"> <span class="price">
                                                            {{ $product->product_discount_price }}
                                                        </span><span class="price-before-discount">
                                                            {{ $product->product_selling_price }}
                                                        </span>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button data-toggle="tooltip" class="btn btn-primary icon"
                                                                type="button" title="Add Cart"> <i
                                                                    class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn"
                                                                type="button">Add to
                                                                cart</button>
                                                        </li>
                                                        <li class="lnk wishlist"> <a data-toggle="tooltip"
                                                                class="add-to-cart" href="detail.html"
                                                                title="Wishlist">
                                                                <i class="icon fa fa-heart"></i>
                                                            </a> </li>
                                                        <li class="lnk"> <a data-toggle="tooltip"
                                                                class="add-to-cart" href="detail.html"
                                                                title="Compare"> <i class="fa fa-signal"
                                                                    aria-hidden="true"></i> </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section> --}}

                    <!-- ==============================================  PRODUTOS RELACIONADO FINAL ============================================== -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <hr>

    {{-- @include('frontend.body.brands') --}}
@endsection
