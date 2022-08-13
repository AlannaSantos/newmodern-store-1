<?php

/**
 * COPIEI E COLEI A MESMA LÓGICA DA STRIPE CONTROLLER
 * APENAS TIREI TUDO RELACIONADO A API STRIPE.
 * 
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderMail; // PROJETO REAL LUCAS - NÃO FOI DEFINIDO NA DOCUMENTAÇÃO.
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; // PROJETO REAL LUCAS - NÃO FOI DEFINIDO NA DOCUMENTAÇÃO.

class CashController extends Controller
{

    public function CashOrder(Request $request)
    {

        // Se existir cupom na sessão, mostrar a lógica desconto | PROJETO REAL LUCAS | NÃO APRESENTAR
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // Inserir Dados nas duas tabelas (order e order_item)
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_street' => $request->shipping_street,
            'shipping_number' => $request->shipping_number,
            'shipping_hood' => $request->shipping_hood,
            'shipping_district_id' => $request->shipping_district_id,
            'shipping_division_id' => $request->shipping_division_id,
            'postal_code' => $request->postal_code,
            'notes' => $request->notes,

            'payment_type' => 'Espécie',
            'payment_method' => 'Espécie',
            'amount' => $total_amount,

            'invoice_no' => 'NMO-' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        // Enviar os dados p/ e-mail do cliente
        // Pegar todos os dados $order_id e atribui-los à variável $data.
        // Requisito funcional 7: a venda deve apresentar preço, total, data, nome e lista itens
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'order_date' => Carbon::now()->format('d F Y'),
            'name' => $request->name,
            'shipping_street' => $request->shipping_street,
            'shipping_number' => $request->shipping_number,
            'shipping_hood' => $request->shipping_hood,
            'shipping_district_id' => $request->shipping_district_id,
            'shipping_division_id' => $request->shipping_division_id,
            'postal_code' => $request->postal_code,
            'notes' => $request->notes,
        ];

        // Passar os dados da variável $data p/ a função build() de OrderMail localizado em app/Mail/OrderMail.php
        Mail::to($request->email)->send(new OrderMail($data));

        // Pegar todo o conteúdo, isto é, todos os itens do carrinho
        $carts = Cart::content();
        // For each loop para itemCarrinho
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id, // variável atribuida a Table order, fk_order_id
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }

        // Após finalizar a venda, esquecer o cupom e destruir o carrinho (esvaziar)
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // Destruir cartão (esvaziar) após efetuar compra e retornar p/ a a lista de pedidos user
        Cart::destroy();

        $notification = array(
            'message' => 'Compra Efetuada Com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }
}
