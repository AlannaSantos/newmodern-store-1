<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        {{-- <li><a href="#"><i class="icon fa fa-user"></i>

                                Minha Conta

                            </a></li> --}}

                        <!-- ================ PROJETO FUTURO WISHLIST ==================== -->
                        {{-- <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>
                                <!-- CONDIÇÃO: verificar a sessão do usuário, se for portugues, mostrar a opção inglês, se for inglês, mostrar opção português -->
                                @if (session()->get('language') == 'portuguese')
                                    Lista de Desejos
                                @else
                                    Wishlist
                                @endif
                            </a>
                        </li> --}}
                        <!-- ================ PROJETO FUTURO WISHLIST ==================== -->

                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>

                                Meu Carrinho

                            </a>
                        </li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>

                                Checkout

                            </a></li>

                        <!-- Se o usuario estiver logado(auth), mostra o icone usuario e link para entrar no perfil -->
                        @auth
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-user"></i>

                                    Perfil Usuário

                                </a></li>

                            <!-- Se usuário não estiver logado, mostra o icone lock(cadeado) e link para realizar login ou registro -->
                        @else
                            <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                                    <!-- CONDIÇÃO: verificar a sessão do usuário, se for portugues, mostrar a opção inglês, se for inglês, mostrar opção português -->

                                    Entrar/Registrar

                                </a></li>

                        @endauth
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">

                    <!-- ============================================================= LOGO ============================================================= -->

                    <div class="logo"> <a href="{{ url('/') }}"> <img
                                src="{{ asset('frontend/assets/images/logo-header-edit.png') }}" alt="logo"> </a>

                    </div>

                </div>


                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">

                    {{-- PLACE HOLDER --}}

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">

                    <!-- =========================== SHOPPING CART DROPDOWN =========================== -->
                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                                <div class="total-price-basket"> <span class="lbl"></span>
                                    <span class="total-price"> <span class="sign">R$</span>
                                        <span class="value" id="cartSubTotal"> </span> </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!--   // Mini carrinho header com AJAX -->

                                <div id="miniCart">

                                    {{-- LÓGICA ESTÁ NOS MÉTODOS GET/POST AJAX
                                    LOCALIZADO NA MAIN_MASTER.BLADE.PHP --}}

                                </div>

                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span>
                                        <span class='price' id="cartSubTotal"> </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>


                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown"
                                        class="dropdown-toggle" data-toggle="dropdown">


                                        Pagina Incial

                                    </a>
                                </li>


                                <!-- ======= DEIXAR O MENU DROPDOWN DINÂMICO CHAMANDO AS CATEGORIAS DO PAINEL ADMIN ======= -->

                                <!-- Relacionar a subcategoria com a fk categoria; quando bater com a categoria id, então, order by ascendente -->

                                @php
                                    $categories = App\Models\Category::orderBy('category_name_pt', 'ASC')->get();
                                @endphp


                                @foreach ($categories as $category)
                                    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown"
                                            class="dropdown-toggle" data-toggle="dropdown">


                                            {{ $category->category_name_pt }}

                                        </a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">


                                                        <!-- =========================== DEIXAR O MENU DROPDOWN DINÂMICO CHAMANDO AS SUB-CATEGORIAS DO PAINEL ADMIN =========================== -->

                                                        <!-- Relacionar a subcategoria com a fk categoria; quando bater com a categoria id, então, order by ascendente -->
                                                        @php
                                                            $subcategories = App\Models\SubCategory::where('category_id', $category->id)
                                                                ->orderBy('subcategory_name_pt', 'ASC')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($subcategories as $subcategory)
                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                <!-- CONDIÇÃO IF ELSE: se a sessão for em ptbr, mostrar nome ptbr caso contrário, mostrar inglês -->
                                                                <a
                                                                    href="{{ url('subcategory/product/' . $subcategory->id . '/' . $subcategory->subcategory_slug_pt) }}">
                                                                    <h2 class="title">

                                                                        {{ $subcategory->subcategory_name_pt }}

                                                                    </h2>
                                                                </a>


                                                                <!-- =========================== DEIXAR O MENU DROPDOWN DINÂMICO CHAMANDO AS SUB-SUB-CATEGORIAS DO PAINEL ADMIN =========================== -->

                                                                <!-- Relacionar a subsubcategoria com a fk subcategoria; quando bater com a subcategoria id, então, order by ascendente -->
                                                                @php
                                                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)
                                                                        ->orderBy('subsubcategory_name_pt', 'ASC')
                                                                        ->get();
                                                                @endphp

                                                                @foreach ($subsubcategories as $subsubcategory)
                                                                    <!-- CONDIÇÃO IF ELSE: se a sessão for em ptbr, mostrar nome ptbr caso contrário, mostrar inglês -->
                                                                    <ul class="links">
                                                                        <li><a
                                                                                href="{{ url('subsubcategory/product/' . $subsubcategory->id . '/' . $subsubcategory->subsubcategory_slug_pt) }}">

                                                                                {{ $subsubcategory->subsubcategory_name_pt }}

                                                                            </a></li>

                                                                    </ul>
                                                                @endforeach

                                                            </div>
                                                        @endforeach



                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                            <img class="img-responsive"
                                                                src="{{ asset('frontend/assets/images/logo.png') }}"
                                                                alt="">
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach

                                <li class="dropdown  navbar-right special-menu"> <a href="#">

                                        Oferta do
                                        dia

                                    </a>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
