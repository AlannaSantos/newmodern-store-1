@extends('frontend.main_master')
@section('content')
@section('title')
    NewModern | Sub-Sub Categoria
@endsection

<!-- Utilizei o a pagina category.html do template flipmart -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Tags</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ======= MENU VERTICAL CATEGORIAS =========== -->
                @include('frontend.fragments.vertical_menu')
                <!-- ===== MENU VERTICAL CATEGORIAL FINAL ======== -->




                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORIA ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">

                                Comprar por

                            </h3>
                            <div class="widget-header">
                                <h4 class="widget-title">

                                    Categoria

                                </h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">


                                    @foreach ($categories as $category)
                                        <div class="accordion-group">
                                            <div class="accordion-heading"> <a href="#collapse{{ $category->id }}"
                                                    data-toggle="collapse" class="accordion-toggle collapsed">

                                                    {{ $category->category_name_pt }}

                                                </a> </div>

                                            <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                                style="height: 0px;">
                                                <div class="accordion-inner">

                                                    {{-- bloco php para chamar a Model Subcategoria, 
                                                        para, assim, poder relacionar as categorias 
                                                        com suas respectivas categorias --}}
                                                    @php
                                                        $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                            ->orderBy('subcategory_name_pt', 'ASC')
                                                            ->get();
                                                    @endphp

                                                    @foreach ($subcategories as $subcategory)
                                                        <ul>
                                                            <li><a
                                                                    href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug_pt) }}">

                                                                    {{ $subcategory->subcategory_name_pt }}

                                                                </a>
                                                            </li>

                                                        </ul>
                                                    @endforeach


                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- ============================================== SIDEBAR CATEGORIA TERMINA AQUI ============================================== -->

                        <!-- ============================================== PREÇO SILDER COMEÇA AQUI ============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Price Slider</h4>
                            </div>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="price-range-holder"> <span class="min-max"> <span
                                            class="pull-left">$200.00</span> <span class="pull-right">$800.00</span>
                                    </span>
                                    <input type="text" id="amount"
                                        style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                    <input type="text" class="price-slider" value="">
                                </div>
                                <!-- /.price-range-holder -->
                                <a href="#" class="lnk btn btn-primary">Show Now</a>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}

                        <!-- ============================================== PREÇO SILDER TERMINA AQUI ============================================== -->
                        <!-- ============================================== MARCAS COMEÇA AQUI ============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Manufactures</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    <li><a href="#">Forever 18</a></li>
                                    <li><a href="#">Nike</a></li>
                                    <li><a href="#">Dolce & Gabbana</a></li>
                                    <li><a href="#">Alluare</a></li>
                                    <li><a href="#">Chanel</a></li>
                                    <li><a href="#">Other Brand</a></li>
                                </ul>
                                <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}

                        <!-- ============================================== MARCAS TERMINA AQUI ============================================== -->
                        <!-- ============================================== CORES COMEÇA AQUI ============================================== -->
                        {{-- <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Colors</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <ul class="list">
                                    <li><a href="#">Red</a></li>
                                    <li><a href="#">Blue</a></li>
                                    <li><a href="#">Yellow</a></li>
                                    <li><a href="#">Pink</a></li>
                                    <li><a href="#">Brown</a></li>
                                    <li><a href="#">Teal</a></li>
                                </ul>
                            </div>
                            <!-- /.sidebar-widget-body -->
                        </div> --}}

                        <!-- ============================================== COLOR: END ============================================== -->
                        <!-- == ======= COMPARE==== ==== -->
                        {{-- <div class="sidebar-widget wow fadeInUp outer-top-vs">
                            <h3 class="section-title">Compare products</h3>
                            <div class="sidebar-widget-body">
                                <div class="compare-report">
                                    <p>You have no <span>item(s)</span> to compare</p>
                                </div>
                              
                            </div>
                          
                        </div> --}}

                        <!-- ============================================== COMPARE: END ============================================== -->


                        <!-- ======== PRODUCT TAGS COMEÇA AQUI =========== -->

                        {{-- @include('frontend.fragments.product_tags') --}}

                        <!-- ======== PRODUCT TAGS TERMINA AQUI ========== -->






                        <!-- ========= AVALIAÇÕES COMEÇA AQUI ============ -->

                        {{-- @include('frontend.fragments.store_reviews') --}}

                        <!-- ========= AVALIAÇÕES TERMINA AQUI ============ -->


                        <!-- ========= DOWNLOAD APP BANNER ============ -->
                        {{-- <div class="home-banner"> <img
                                src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div> --}}

                    </div>
                </div>
            </div>

            <div class='col-md-9'>



                <!-- ======= SECTION – HERO ========= -->

                {{-- <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"> <img src="{{ asset('frontend/assets/images/banners/cat-banner-1.jpg') }}"
                                alt="" class="img-responsive"> </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text"> Big Sale </div>
                                <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                                <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div> --}}


                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">position</a></li>
                                                <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">

                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span>
                                            </button>

                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-sm-6 col-md-4 text-right">

                        </div>
                    </div>
                </div>


                <!-- ================= GRID VIEW PRODUTOS COMEÇA AQUI ================= -->
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">

                                    @foreach ($products as $product)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}"><img
                                                                    src="{{ asset($product->product_thumbnail) }}"
                                                                    alt=""></a> </div>


                                                        <!-- Lógica porcentagem -->
                                                        @php
                                                            $discount = $product->product_selling_price - $product->product_discount_price;
                                                            $percentage = ($discount / $product->product_selling_price) * 100;
                                                        @endphp

                                                        <div>
                                                            @if ($product->product_discount_price == null)
                                                                <div class="tag new"><span>new</span></div>
                                                            @else
                                                                <div class="tag hot">
                                                                    <span>{{ round($percentage) }}%</span>
                                                                </div>
                                                            @endif
                                                        </div>


                                                    </div>


                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a
                                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">

                                                                {{ $product->product_name_pt }}

                                                            </a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>


                                                        @if ($product->product_discount_price == null)
                                                            <div class="product-price"> <span class="price">
                                                                    R${{ $product->product_selling_price }} </span>
                                                            </div>
                                                        @else
                                                            <div class="product-price"> <span class="price">
                                                                    R${{ $product->product_discount_price }} </span>
                                                                <span class="price-before-discount">R$
                                                                    {{ $product->product_selling_price }}</span>
                                                            </div>
                                                        @endif


                                                    </div>
                                                    <!-- ================= ADD TO CART ================= -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button"> <i
                                                                            class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>
                                                                </li>
                                                                <!-- ================= ADD TO WISHLIST================= -->
                                                                {{-- <li class="lnk wishlist"> 
                                                                    <a class="add-to-cart"
                                                                        href="detail.html" title="Wishlist"> <i
                                                                            class="icon fa fa-heart"></i> 
                                                                        </a> 
                                                                    </li>

                                                                <!-- ================= ADD TO WISHLIST================= -->
                                                                <li class="lnk"> 
                                                                    <a class="add-to-cart"
                                                                        href="detail.html" title="Compare"> <i
                                                                            class="fa fa-signal"></i> 
                                                                        </a> 
                                                                    </li> --}}
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


                        <!-- ================= LIST VIEW PRODUTOS COMEÇA AQUI ================= -->
                        <div class="tab-pane " id="list-container">
                            <div class="category-product">

                                @foreach ($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image"> <img
                                                                    src="{{ asset($product->product_thumbnail) }}"
                                                                    alt=""> </div>
                                                        </div>

                                                    </div>

                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a
                                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug_pt) }}">

                                                                    {{ $product->product_name_pt }}

                                                                </a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>


                                                            @if ($product->product_discount_price == null)
                                                                <div class="product-price"> <span class="price">
                                                                        R${{ $product->product_selling_price }}
                                                                    </span> </div>
                                                            @else
                                                                <div class="product-price"> <span class="price">
                                                                        R${{ $product->product_discount_price }}
                                                                    </span> <span class="price-before-discount">R$
                                                                        {{ $product->product_selling_price }}</span>
                                                                </div>
                                                            @endif


                                                            <div class="description m-t-10">

                                                                {{ $product->product_short_description_pt }}

                                                            </div>
                                                            <!-- ========== BOTÃO ADD TO CART ============ -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <button class="btn btn-primary icon"
                                                                                data-toggle="dropdown" type="button">
                                                                                <i class="fa fa-shopping-cart"></i>
                                                                            </button>
                                                                            <button class="btn btn-primary cart-btn"
                                                                                type="button">Add to cart</button>
                                                                        </li>

                                                                        {{-- <li class="lnk wishlist"> <a
                                                                                class="add-to-cart" href="detail.html"
                                                                                title="Wishlist"> <i
                                                                                    class="icon fa fa-heart"></i> </a>
                                                                        </li> --}}

                                                                        {{-- <li class="lnk"> <a class="add-to-cart"
                                                                                href="detail.html" title="Compare"> <i
                                                                                    class="fa fa-signal"></i> </a>
                                                                        </li> --}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Lógica porcentagem -->
                                                @php
                                                    $discount = $product->product_selling_price - $product->product_discount_price;
                                                    $percentage = ($discount / $product->product_selling_price) * 100;
                                                @endphp

                                                <!-- /.product-list-row -->
                                                <div>
                                                    @if ($product->product_discount_price == null)
                                                        <div class="tag new"><span>new</span></div>
                                                    @else
                                                        <div class="tag hot"><span>{{ round($percentage) }}%</span>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- ================= LIST VIEW PRODUTOS TERMINA AQUI ================= -->

                            </div>
                        </div>
                    </div>

                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">
                                <!-- função paginate do Laravel (links), serve para mostrar variás paginas (previous/next)-->
                                <ul class="list-inline list-unstyled">
                                    {{ $products->links() }}
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================== MARCAS CAROUSEL COMEÇA AQUI ============================================== -->
        {{-- <div id="brands-carousel" class="logo-slider wow fadeInUp">
            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item m-t-10"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->

                    <div class="item"> <a href="#" class="image"> <img
                                data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif"
                                alt=""> </a> </div>
                    <!--/.item-->
                </div>
                <!-- /.owl-carousel #logo-slider -->
            </div>
            <!-- /.logo-slider-inner -->

        </div> --}}

        <!-- ============================================== MARCAS CAROUSEL TERMINA AQUI ============================================== -->
    </div>
</div>

@endsection
