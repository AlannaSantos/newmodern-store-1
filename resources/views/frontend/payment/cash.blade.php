@extends('frontend.main_master')
@section('content')

    {{-- COPIEI VIEW STRIPE, COLEI AQUI AQUI NA VIEW PAGAMENTO-ESPÉCIE
COMO NÃO ENVOLVE NADA DA API STRIPE, TIREI O STYLE E JS 
AMBOS TIRADOS DA DOCUMENTAÇÃO API. --}}

@section('title')
    NewModern | Pagamento espécie
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Pagamento Cartao</li>
            </ul>
        </div>
    </div>
</div>

<!-- ========= VALOR TOTAL DOS ITENS ========= -->
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">

                <div class="col-md-6">

                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        Valor Total
                                    </h4>
                                </div>

                                <div class="">

                                    <!-- ========= LÓGICA CUPOM | TRABALHO REAL LUCAS | AINDA NÃO FUNCIONA ========= -->
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        <hr>
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>Subtotal : </strong> ${{ $cartTotal }}
                                                <hr>

                                                <strong>Nome : </strong>
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ( {{ session()->get('coupon')['coupon_discount'] }} % )
                                                <hr>

                                                <strong>Desconto : </strong>
                                                ${{ session()->get('coupon')['discount_amount'] }}
                                                <hr>

                                                <strong>Total : </strong>
                                                ${{ session()->get('coupon')['total_amount'] }}
                                                <hr>
                                            @else
                                                <strong>Subtotal : </strong> ${{ $cartTotal }}
                                                <hr>

                                                <strong>Total : </strong> ${{ $cartTotal }}
                                                <hr>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========= PAGAMENTO EM ESPÉCIE ========= -->
                <div class="col-md-6">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        Pagamento em espécie
                                    </h4>
                                </div>

                                <!-- ========== ROTA ESTÁ PROTEGIDA COM MIDDLEWARE AUTH:USER ========== -->
                                <form action="{{ route('cash.order') }} " method="post" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">

                                            <input type="hidden" name="name" value="{{ $data['name'] }}">

                                            <input type="hidden" name="email" value="{{ $data['email'] }}">

                                            <input type="hidden" name="phone" value="{{ $data['phone'] }}">

                                            <input type="hidden" name="shipping_street"
                                                value="{{ $data['shipping_street'] }}">

                                            <input type="hidden" name="shipping_number"
                                                value="{{ $data['shipping_number'] }}">

                                            <input type="hidden" name="shipping_hood"
                                                value="{{ $data['shipping_hood'] }}">

                                            <input type="hidden" name="shipping_district_id"
                                                value="{{ $data['shipping_district_id'] }}">

                                            <input type="hidden" name="shipping_division_id"
                                                value="{{ $data['shipping_division_id'] }}">

                                            <input type="hidden" name="postal_code"
                                                value="{{ $data['postal_code'] }}">

                                            <input type="hidden" name="notes" value="{{ $data['notes'] }}">

                                        </label>
                                    </div><br>

                                    <button class="btn btn-primary">
                                        Proceder
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
