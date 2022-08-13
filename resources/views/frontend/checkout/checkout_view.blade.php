@extends('frontend.main_master')
@section('content')

    <!-- JQuery CDN p/ trabalhar com JS Ajax (mostrar estado e Cidade dinamicamente no select field) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
    NewModern | Checkout
@endsection


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div>
    </div>
</div>


<!--=================== CHECKOUT MAIN CONTENT =================== -->
<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">

                        <div class="panel panel-default checkout-step-01">


                            <!--===================== CABEÇALHO DO PAINEL(ESTÉTICA OPCIONAL) ===================== -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion"
                                        href="#collapseOne">
                                        <span><i class="fa fa-ship"></i></span>
                                        Informações de Envio
                                    </a>
                                </h4>
                            </div>
                            <hr>

                            <!--===================== DADOS CLIENTE ===================== -->
                            <div id="collapseOne" class="panel-collapse collapse in">


                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>
                                                    SEUS DADOS
                                            </h4><br>

                                            <form class="register-form" action="{{ route('checkout.store') }}"
                                                method="POST">
                                                @csrf

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">

                                                        Nome Completo

                                                        <span>*</span>
                                                    </label>
                                                    <input type="text" name="name"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder=""
                                                        value="{{ Auth::user()->name }}" required="">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">

                                                        Email

                                                        <span>*</span>
                                                    </label>
                                                    <input type="email" name="email"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder=""
                                                        value="{{ Auth::user()->email }}" required="">
                                                </div>

                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">

                                                        Telefone

                                                        <span>*</span>
                                                    </label>
                                                    <input type="text" name="phone"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder=""
                                                        value="{{ Auth::user()->phone }}" required="">
                                                </div>
                                        </div>

                                        <!--===================== LÓGICA CORREIO ===================== -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle"><b>ENDEREÇO</b></h4>



                                            <div class="form-group">
                                                <h5><b>
                                                        {{-- @if (session()->get('language') == 'portuguese')
                                                            Selecionar Estado
                                                        @else
                                                            Select State
                                                        @endif --}}
                                                        {{-- </b> <span class="text-danger">*</span> --}}
                                                </h5>
                                                <div class="controls">
                                                    <select name="shipping_division_id" class="form-control"
                                                        required="">
                                                        <option value="" selected="" disabled="">

                                                            Estado

                                                        </option>
                                                        @foreach ($divisions as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->shipping_division_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('shipping_division_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <h5><b>
                                                        {{-- @if (session()->get('language') == 'portuguese')
                                                            Selecionar Cidade
                                                        @else
                                                            Select City
                                                        @endif --}}
                                                        {{-- </b> <span class="text-danger">*</span> --}}
                                                </h5>
                                                <div class="controls">
                                                    <select name="shipping_district_id" class="form-control"
                                                        required="">
                                                        <option value="" selected="" disabled="">

                                                            Cidade

                                                        </option>

                                                    </select>
                                                    @error('shipping_district_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">

                                                    Rua

                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="shipping_street"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" placeholder="" required="">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">

                                                    Numero

                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="shipping_number"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" placeholder="" required="">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">

                                                    Bairro

                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="shipping_hood"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" placeholder="" required="">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">

                                                    CEP

                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="postal_code"
                                                    class="form-control unicase-form-control text-input"
                                                    id="exampleInputEmail1" placeholder="" required="">

                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">

                                                    Observações

                                                    <span class="text-info">(Opcional)</span>
                                                </label>
                                                <textarea class="form-control" cols="30" rows="5" placeholder="..." name="notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default checkout-step-02">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion"
                                        href="#collapseTwo">
                                        <span><i class="fa fa-credit-card"></i></span>
                                        Método de Pagamento
                                    </a>
                                </h4>
                            </div>
                            <hr>

                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Explicar condições, tempo de entrega, condições de retorno,
                                    Tipos de pagamento, etc...
                                    Inserir Imagens de cartões...
                                    Tentar deixar essa parte mais atraente

                                </div>
                                <br>

                                <div class="row">
                                    <!--=================== PAGAMENTO STRIPE (CC) =================== -->
                                    <div class="col-md-10">
                                        <input type="radio" name="payment_method" value="stripe">
                                        <label for="">

                                            Cartão

                                        </label>
                                        {{-- <img src="{{ asset('frontend/assets/images/payments/4.png') }}">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}">
                                       <img src="{{ asset('frontend/assets/images/payments/2.png') }}"> --}}
                                    </div>
                                    <br>

                                    <!--=================== PAGAMENTO ESPÉCIE =================== -->
                                    <div class="col-md-10">
                                        <input type="radio" name="payment_method" value="cash">
                                        <label for="">

                                            Espécie

                                        </label>
                                    </div>
                                </div>

                                <!--=================== PAGAMENTO CARTÃO =================== -->
                                {{-- <div class="col-md-10">
                                    <input type="radio" name="payment_method" value="card">
                                    <label for="">

                                        Cartão

                                    </label>
                                </div> --}}

                                <!--=================== PAGAMENTO PAYPAL =================== -->
                                {{-- <div class="col-md-10">
                                        <input type="radio" name="payment_method" value="paypal">
                                        <label for="">
                                            PayPal
                                        </label>

                                      <img src="{{ asset('frontend/assets/images/payments/1.png') }}"> 
                                    </div> --}}

                            </div>
                            <br>
                            <br>

                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">

                                Enviar

                            </button>
                            </form>
                        </div>

                    </div>

                </div>

                <!--=================== CHECKOUT SIDEBAR (PROGRESSO) =================== -->
                <div class="col-md-4">
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">

                                        Produto(s)

                                    </h4>
                                </div>
                                <div class="">

                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <!-- ==== BLOCO FOR EACH: chamar itens carrinho (página dinâmica) ==== -->
                                        @foreach ($carts as $item)
                                            <li>

                                                <img src="{{ asset($item->options->image) }}"
                                                    style="width:50px; height:50px;">
                                            </li>
                                            <br>

                                            <li>
                                                <strong>Valor produto:</strong> R$ {{ $item->price }}
                                            </li>
                                            <li>
                                                <strong>Quantidade:</strong> {{ $item->qty }}
                                            </li>

                                            <li>
                                                <strong>Cor:</strong> {{ $item->options->color }}
                                            </li>

                                            <li>
                                                <strong>Tamanho:</strong> {{ $item->options->size }}
                                            </li>

                                            <hr>
                                        @endforeach


                                        <li>
                                            {{-- CONDIÇÃO (FUTURO): se cupom foi tilizado,autenticar pela sessão e mostrar a lógica valor final
                                                caso contrário, seguir checkout normalmente --}}
                                            @if (Session::has('coupon'))
                                                <strong>

                                                    Subtotal:

                                                </strong>
                                                {{ $cartTotal }}
                                                <hr>

                                                <strong>

                                                    Cupom Utilizado:

                                                </strong>
                                                <!-- === PEGAR NOME CUPOM UTILIZADO NA SESSÃO === -->
                                                {{ session()->get('coupon')['coupon_name'] }}


                                                <strong>

                                                    Desconto:

                                                </strong>
                                                <!-- === PEGAR A PERCENTAGEM DO CUPOM === -->
                                                {{ session()->get('coupon')['discount_amount'] }}

                                                <strong>

                                                    Total com Desconto:

                                                </strong>
                                                <!-- === PEGAR A PERCENTAGEM DO CUPOM === -->
                                                {{ session()->get('coupon')['total_amount'] }}
                                                <hr>
                                            @else
                                                <strong>

                                                    Subtotal:

                                                </strong>
                                                {{ $cartTotal }}
                                                <br>

                                                <!-- OPCIONAL: MOSTRAR TOTAL. APÓS SUBTOTAL (SÓ DESCOMENTAR) -->
                                                <strong>

                                                    Total:

                                                </strong>
                                                {{ $cartTotal }}
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- @include('frontend.body.brands') --}}
    </div>
</div>

{{-- Código JS Ajax para Estado e Cidade dinamicamente eu simplesmente 
    copiei a mesma lógica do categoria produtos --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="shipping_division_id"]').on('change', function() {
            var shipping_division_id = $(this).val();
            if (shipping_division_id) {
                $.ajax({
                    url: "{{ url('/district-get/ajax') }}/" + shipping_division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="shipping_district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="shipping_district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .shipping_district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });
</script>

@endsection
