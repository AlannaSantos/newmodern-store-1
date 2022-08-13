@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('frontend.fragments.user_sidebar')

                <div class="col-md-8">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">

                                PENSAR EM TÍTULO MELHOR

                            </span><strong>
                                <br>
                                {{ Auth::user()->name }}</strong>
                            <br>
                            <br>
                        </h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- PLACE HOLDER | COLOCAR ARTE AQUI -->
                </div>


                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">

                                        Imagem

                                    </th>

                                    <th class="cart-description item">

                                        Produto

                                    </th>

                                    <th class="cart-product-name item">

                                        Codigo Produto

                                    </th>

                                    <th class="cart-product-name item">

                                        Cor

                                    </th>

                                    <th class="cart-edit item">

                                        Tamanho

                                    </th>

                                    <th class="cart-qty item">

                                        Quantidade

                                    </th>

                                    <th class="cart-sub-total item">

                                        Preço

                                    </th>

                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($orderItem as $item)
                                    <tr>

                                        <td class="col-md-2">
                                            <label for="">
                                                <img src="{{ asset($item->product->product_thumbnail) }}" height="50px;"
                                                    width="50px;">
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->product->product_name_pt }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->product->product_code }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->color }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->size }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->qty }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> R$ {{ $item->price }} </label>
                                            <label for="">R$ {{ $item->price * $item->qty }} </label>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <hr>


                    <!-- ====== ARRUMAR TABLE DADOS ENVIO ====== -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Endereço</h4>
                                <span class="text-danger">Informações Envio</span>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>

                                            <tr style="background: #a9cbf3a4;">

                                                <td class="col-md-2">
                                                    <label for="">

                                                        Rua

                                                    </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">

                                                        Numero

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        Bairro

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        Cidade

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        Estado

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        CEP

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        DATA

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <label for="">

                                                        Obser.

                                                    </label>
                                                </td>

                                            </tr>

                                            <tr>

                                                <td class="col-md-2">
                                                    <label for=""> {{ $order->shipping_street }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->shipping_number }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->shipping_hood }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->district->shipping_district_name }}
                                                    </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->division->shipping_division_name }}
                                                    </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->postal_code }} </label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->order_date }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">{{ $order->notes }}</label>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                            <hr>

                            <!-- ====== ARRUMAR TABLE DADOS PEDIDO ====== -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detalhes Pedido</h4>
                                        <span class="text-danger">Invoice: {{ $order->invoice_no }}</span>


                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>

                                                    <tr style="background: #a9cbf3a4;">
                                                        <td class="col-md-1">
                                                            <label for="">
                                                                Nome

                                                            </label>
                                                        </td>

                                                        {{-- <td class="col-md-3">
                                                                <label for="">
                                                                    @if (session()->get('language') == 'portuguese')
                                                                        Telefone
                                                                    @else
                                                                        Phone
                                                                    @endif
                                                                </label>
                                                            </td>

                                                            <td class="col-md-3">
                                                                <label for="">
                                                                    Email
                                                                </label>
                                                            </td> --}}

                                                        <td class="col-md-2">
                                                            <label for="">
                                                                Método de Pagamento

                                                            </label>
                                                        </td>

                                                        {{-- <td class="col-md-2">
                                                                <label for="">
                                                                    @if (session()->get('language') == 'portuguese')
                                                                        Numero Transação
                                                                    @else
                                                                        Transaction Id
                                                                    @endif
                                                                </label>
                                                            </td> --}}

                                                        <td class="col-md-2">
                                                            <label for="">
                                                                Numero Boleto

                                                            </label>
                                                        </td>

                                                        <td class="col-md-1">
                                                            <label for="">
                                                                Valor Total

                                                            </label>
                                                        </td>

                                                        <td class="col-md-1">
                                                            <label for="">
                                                                Status

                                                            </label>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td class="col-md-3">
                                                            <label for=""> {{ $order->user->name }} </label>
                                                        </td>

                                                        {{-- <td class="col-md-3">
                                                                <label for=""> {{ $order->user->phone }}</label>
                                                            </td>

                                                            <td class="col-md-3">
                                                                <label for=""> {{ $order->user->email }}</label>
                                                            </td> --}}

                                                        <td class="col-md-3">
                                                            <label for="">
                                                                {{ $order->payment_method }}</label>
                                                        </td>

                                                        {{-- <td class="col-md-2">
                                                                <label for="">
                                                                    {{ $order->transaction_id }}</label>
                                                            </td> --}}

                                                        <td class="col-md-2">
                                                            <label for="">{{ $order->invoice_no }}</label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <label for="">{{ $order->amount }}</label>
                                                        </td>

                                                        <td class="col-md-2">
                                                            <span class="badge badge-pill badge-warning"
                                                                style="background: #418DB9;">{{ $order->status }}
                                                            </span>
                                                        </td>

                                                    </tr>
                                                    <hr>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- @include('frontend.body.brands') --}}
@endsection
