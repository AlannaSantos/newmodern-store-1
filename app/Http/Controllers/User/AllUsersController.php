<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUsersController extends Controller
{
    // MÉTODO PARA ACESSAR A VIEW PAGE MEUSPEDIDOS DO USUÁRIO AUTENTICADO PROTEGIDO PELO MIDDLEWARE USERS
    public function MyOrders()
    {
        // Acessar a Models(table) Order(pedido-envio)...
        // pegando todos os dados do usuário autenticado e atribuindo-ps à variável $orders.
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.order_view', compact('orders'));
    }

    // MÉTODO PARA ACESSAR A VIEW PAGE PEDIDOESPECIFICO DO USUÁRIO AUTENTICADO PROTEGIDO PELO MIDDLEWARE USERS
    public function OrderDetails($order_id)
    {
        // Aqui retorna todos os dados Models Order (pedido-envio) com a relação tables estado, cidade e user e atribuí-os à variável $order
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.order_details', compact('order', 'orderItem'));
    }

    // MÉTODO P/ BAIXAR BOLETO EM PDF - COPIEI A MESMA LÓGICA DO MÉTODO PEDIDOESPECIFICO
    public function InvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.order.order_invoice', compact('order', 'orderItem'));

        $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
