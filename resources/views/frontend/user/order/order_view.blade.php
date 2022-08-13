@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('frontend.fragments.user_sidebar')

                <div class="col-md-10">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">

                                Olá!

                            </span><strong>
                                {{ Auth::user()->name }}</strong>
                            <br>
                            <br>

                            Aqui estão todos os seus pedidos

                        </h3>
                        <hr>

                        <!-- ====== ARRUMAR ESSA TABLE ====== -->
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>

                                        <tr style="background: #a9cbf3a4;">
                                            <td class="col-md-1">
                                                <label for="">
                                                    Data

                                                </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> Total</label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for="">
                                                    Pagamento

                                                </label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">
                                                    Numero Pedido

                                                </label>
                                            </td>

                                            <td class="col-md-2">
                                                <label for="">
                                                    Pedido

                                                </label>
                                            </td>

                                            <td class="col-md-1">
                                                <label for="">
                                                    Ação

                                                </label>
                                            </td>

                                        </tr>


                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="col-md-3">
                                                    <label for=""> {{ $order->order_date }}</label>
                                                </td>

                                                <td class="col-md-3">
                                                    <label for=""> R$ {{ $order->amount }}</label>
                                                </td>


                                                <td class="col-md-3">
                                                    <label for=""> {{ $order->payment_method }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for=""> {{ $order->invoice_no }}</label>
                                                </td>

                                                <td class="col-md-2">
                                                    <label for="">
                                                        <span class="badge badge-pill badge-info"
                                                            style="background: #418DB9;">{{ $order->status }} </span>

                                                    </label>
                                                </td>

                                                <td class="col-md-1">
                                                    <a href="{{ url('user/order_details/' . $order->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>
                                                        Visua..

                                                    </a>

                                                    {{-- \_blank: Load the URL into a new browsing context. This is usually a tab, 
                                                    but users can configure browsers to use new windows instead. --}}
                                                    <a target="_blank"
                                                        href="{{ url('user/invoice_download/' . $order->id) }}"
                                                        class="btn btn-me btn-success" style="margin-top: 5px;"><i
                                                            class="fa fa-download" style="color: white;"></i>
                                                        Boleto

                                                    </a>

                                                </td>

                                            </tr>
                                        @endforeach
                                        <br>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    {{-- @include('frontend.body.brands') --}}
@endsection
