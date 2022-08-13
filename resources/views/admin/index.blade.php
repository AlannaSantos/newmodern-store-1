@extends('admin.admin_master')
@section('admin')
    {{-- BLOCO PHP: APÓS DEFINIR A LÓGICA DO BACK-END
    UTILIZA-SE ESTE BOLOCO PARA VISUALIZAR OS DADOS
    OU SEJA, COMUNICAÇÃO COM O BD/FRONT-END --}}

    @php

    $date = date('d-M-y');
    $date = App\Models\Order::where('order_date')->sum('amount');

    $month = date('F');
    $month = App\Models\Order::where('order_month', $month)->sum('amount');

    $year = date('Y');
    $year = App\Models\Order::where('order_year', $year)->sum('amount');

    $users = App\Models\User::all()->count();

    $orders = App\Models\Order::where('status', 'pending')->get();

    \Carbon\Carbon::setLocale('pt_BR');

    @endphp

    <div class="content-wrapper" style="min-height: 326px;">
        <div class="container-full">

            <section class="content">
                <div class="row">
                    <div class="col-xl-3 col-6">
                        <div class="box overflow-hidden pull-up">
                            <div class="box-body">
                                <div class="icon bg-primary-light rounded w-60 h-60">
                                    <i class="text-primary mr-0 font-size-24 mdi mdi-sale"></i>
                                </div>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">Vendas diárias</p>
                                    <h3 class="text-white mb-0 font-weight-500">R$ {{ $date }} <small
                                            class="text-success"><i class="fa fa-caret-up"></i> BRL</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-6">
                        <div class="box overflow-hidden pull-up">
                            <div class="box-body">
                                <div class="icon bg-warning-light rounded w-60 h-60">
                                    <i class="text-warning mr-0 font-size-24 mdi mdi-sale"></i>
                                </div>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">Vendas mensais</p>
                                    <h3 class="text-white mb-0 font-weight-500">R$ {{ $month }} <small
                                            class="text-success"><i class="fa fa-caret-up"></i> BRL</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-6">
                        <div class="box overflow-hidden pull-up">
                            <div class="box-body">
                                <div class="icon bg-info-light rounded w-60 h-60">
                                    <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                                </div>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">Vendas anuais</p>
                                    <h3 class="text-white mb-0 font-weight-500">R$ {{ $month }} <small
                                            class="text-success"><i class="fa fa-caret-up"></i> BRL</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-6">
                        <div class="box overflow-hidden pull-up">
                            <div class="box-body">
                                <div class="icon bg-success-light rounded w-60 h-60">
                                    <i class="text-info mr-0 font-size-24 mdi mdi-account-multiple"></i>
                                </div>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">Usuários Cadastrados</p>
                                    <h3 class="text-white mb-0 font-weight-500">{{ $users }} <small
                                            class="text-success"><i class="fa fa-caret-up"></i></small></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4 class="box-title align-items-start flex-column">
                                    Pedidos
                                    <small class="subtitle">Conferir os pedidos atuais</small>
                                </h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-border">
                                        <thead>
                                            <tr class="text-uppercase bg-lightest">
                                                <th style="min-width: 250px"><span class="text-white">Data</span></th>
                                                <th style="min-width: 100px"><span class="text-fade">ID Pedido</span></th>                                                        
                                                <th style="min-width: 100px"><span class="text-fade">Valor Total</span></th>
                                                <th style="min-width: 150px"><span class="text-fade">Tipo de Pagamento</span></th>
                                                <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                                <th style="min-width: 120px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orders as $order)
                                                <tr>

                                                    <td>

                                                        <span class="text-white font-weight-600 d-block font-size-16">
                                                            {{ Carbon\Carbon::parse($order->order_date)->diffForHumans() }}
                                                        </span>
                                                    </td>

                                                    <td>

                                                        <span class="text-white font-weight-600 d-block font-size-16">
                                                            {{ $order->invoice_no }}
                                                        </span>
                                                    </td>

                                                    <td>

                                                        <span class="text-white font-weight-600 d-block font-size-16">
                                                            {{ $order->amount }}
                                                        </span>
                                                    </td>

                                                    <td>

                                                        <span class="text-white font-weight-600 d-block font-size-16">
                                                            {{ $order->payment_method }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="badge badge-primary-light badge-lg">{{ $order->status }}</span>
                                                    </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
