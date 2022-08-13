@extends('frontend.main_master')
@section('content')

@section('title')
    NewModern | Meu Carrinho
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Meu Carrinho</li>

            </ul>
        </div>
    </div>
</div>

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-romove item">Imagem</th>
                                        <th class="cart-description item">Produto</th>
                                        <th class="cart-product-name item">Cor</th>
                                        <th class="cart-edit item">Tamanho</th>
                                        <th class="cart-qty item">Quantidade</th>
                                        <th class="cart-sub-total item">Subtotal</th>
                                        <th class="cart-total last-item">Remover</th>

                                    </tr>

                                </thead>

                                <!-- Chamei, pelo Id, o Ajax wishlist codificado na main_master -->
                                <tbody id="mycart">


                                </tbody>
                            </table>
                        </div>
                    </div>



                    <!-- ======================== ADICIONAR CUPOM/VOUCHERS (IMPLEMENTAR FUTURAMENTE) ========================  -->
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">

                        {{-- CONDIÇÃO: após aplicar cupom, esconder o campo (mostrar vazio) p/ aplicar cupom, 
                            evitando que o cliente insira vários em uma compra --}}

                        {{-- @if (Session::has('coupon'))
                        @else
                            <table class="table" id="couponField">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">
                                                @if (session()->get('language') == 'portuguese')
                                                    Código de Desconto
                                                @else
                                                    Discount Code
                                                @endif
                                            </span>
                                            <p>
                                                @if (session()->get('language') == 'portuguese')
                                                    Insira o código do seu voucher
                                                @else
                                                    Enter your coupon code
                                                @endif
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control unicase-form-control text-input"
                                                    placeholder="Insira seu cupom" id="coupon_name">
                                            </div>
                                            <div class="clearfix pull-right">
                                                <button type="submit" class="btn-upper btn btn-primary"
                                                    onclick="applyCoupon()">
                                                    @if (session()->get('language') == 'portuguese')
                                                        APLICAR
                                                        CUPOM
                                                    @else
                                                        APPLY
                                                        COUPON
                                                    @endif
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif --}}
                    </div>

                    <div class="col-md-4 col-sm-12 estimate-ship-tax">

                        {{-- PLACE HOLDER --}}

                    </div>

                    <!-- ======================== CAMPO SUBTOTAL/TOTAL ========================  -->
                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead id="couponCalField">

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout') }}" type="submit"
                                                class="btn btn-primary checkout-btn">

                                                FAZER O
                                                CHECKOUT

                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        {{-- @include('frontend.body.brands') --}}
    </div>
@endsection
