<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comprovante</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: rgb(7, 92, 126);
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: rgb(7, 92, 126);
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top-left">
                <img src="{{ public_path('frontend/assets/images/logo.png') }}" width="300px" height="300px" />
                {{-- <h2 style="color: rgb(7, 92, 126); font-size: 26px;"><strong>NewModern</strong></h2> --}}
            </td>
            <td align="right-center">
                <pre class="font">
                   NewModern Ecommerce<br>
                   Email:suporte@newmodern.com.br <br>
                   WhatsApp +55 45 99818-2382 <br>
                   Foz do Iguaçu - PR 
                </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>
    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Nome:</strong> {{ $order->name }}<br>
                    <strong>Email:</strong> {{ $order->email }}<br>
                    <strong>Telefone:</strong> {{ $order->phone }} <br>

                    @php
                        $division = $order->division->shipping_division_name;
                        $district = $order->district->shipping_district_name;
                    @endphp


                    <strong>Rua:</strong> {{ $order->shipping_street }} <br>
                    <strong>Numero:</strong> {{ $order->shipping_number }} <br>
                    <strong>Bairro:</strong> {{ $order->shipping_hood }} <br>
                    <strong>Cidade:</strong> {{ $division }}<br>
                    <strong>Estado:</strong> {{ $district }} <br>
                    <strong>CEP:</strong> {{ $order->postal_code }} <br>
                    <strong>Observações:</strong> {{ $order->notes }} <br>
                </p>
            </td>

            <td align="top">
                <p class="font" style="margin-right: 20px;">
                <h3><span style="color: darkred">#Comprovante:</span class>{{ $order->invoice_no }}</h3>
                Data do Pedido: {{ $order->order_date }} <br>
                Data Chegada Envio: ESTUDAR ENVIO/LOGISTICA <br>
                Tipo de Pagamento : {{ $order->payment_method }} </span>
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Produto(s)</h3>
    <table width="100%">
        <thead style="background-color: rgb(7, 92, 126); color:#FFFFFF;">

            @foreach ($orderItem as $item)
                <tr class="font">
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Tamanho</th>
                    <th>Cor</th>
                    <th>Codigo </th>
                    <th>Quantidade</th>
                    <th>Preço </th>
                    <th>Total </th>
                </tr>
            @endforeach

        </thead>
        <tbody>

            <tr class="font">
                <td align="center">
                    <img src="{{ public_path($item->product->product_thumbnail) }}" height="60px;" width="60px;"
                        alt="">
                </td>
                <td align="center">{{ $item->product->product_name_en }}</td>
                <td align="center">

                    <!-- CONDIÇÂO: se não existir cor e/ou tamnho no produto, então mostrar nulo -->
                    @if ($item->size == null)
                    @else
                        {{ $item->size }}
                    @endif

                </td>

                <td align="center">
                    <!-- CONDIÇÂO: se não existir cor e/ou tamnho no produto, então mostrar nulo -->
                    @if ($item->color == null)
                    @else
                        {{ $item->color }}
                    @endif

                </td>

                <td align="center">{{ $item->product->product_code }}</td>
                <td align="center">{{ $item->qty }}</td>
                <td align="center">R$ {{ $item->price }}</td>
                <td align="center">R$ {{ $item->price * $item->qty }}</td>
            </tr>

        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: rgb(7, 92, 126);">Subtotal:</span> R$ {{ $item->price }} </h2>
                <h2><span style="color: rgb(7, 92, 126);">Total:</span> R$ {{ $item->price * $item->qty }} </h2>
                {{-- <h2><span style="color: rgb(7, 92, 126);">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Agradecemos a sua preferência</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Equipe NewModern</h5>
    </div>
</body>

</html>
