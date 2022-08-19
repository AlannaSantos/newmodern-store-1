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
                    </div>
                </div>
            </div>

            <div class='col-md-9'>


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

        {{-- INCLUDE BRANDS HERE --}}
    </div>
</div>

@endsection
