<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OrderMail; // PROJETO REAL LUCAS - NÃO FOI DEFINIDO NA DOCUMENTAÇÃO.
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; // PROJETO REAL LUCAS - NÃO FOI DEFINIDO NA DOCUMENTAÇÃO.

class CashController extends Controller
{
    // MÉTODO PAGAMENTO EM ESPÉCIE
    public function CashOrder(Request $request)
    {
        // utilizando funcão do pacote carrinho, pegeui o total carrinho arredindado e atribuí á variável $total_amount
        $total_amount = round(Cart::total());


        // inserir dados nas duas tabelas (order e order_item)
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

            'payment_method' => 'Espécie',
            'amount' => $total_amount,

            'invoice_no' => 'NMO-' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pendente',
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

        /**
         * ENVIAR DADOS COMPRA VIA E-MAIL UTILIZANDO LARAVEL MAIL
         * 
         * TUTORIAL ENCONTRADO EM: https://www.itsolutionstuff.com/post/laravel-9-mail-laravel-9-send-email-tutorialexample.html
         * 
         * PORÉM, NÃO FUNCIONA FORA DO AMBIENTE DE TESTE, OU SEJA, NÃO ESTÁ PRONTO E NÃO DEVE SER COBRADO NA APRESENTAÇÃO
         * 
         * INCLUSIVE, NEM ESTÁ NA DOCUMENTAÇÃO...
         * 
         * LÓGICA:Passar os dados da variável $data p/ a função build() de OrderMail localizado em
         * app/Mail/OrderMail.php
         *  
         * 
         * */ 
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

        // Destruir carrinho após compra finalizada
        Cart::destroy();

        $notification = array(
            'message' => 'Compra Efetuada Com Sucesso',
            'alert-type' => 'success'
        );

        // Após efetuar compra e retornar p/ a a lista de pedidos/envio user
        return redirect()->route('my.orders')->with($notification);
    }
}
