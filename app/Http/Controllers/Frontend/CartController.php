<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\ShippingDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // MÉTODO P/ ADICIONAR ITEM NO CARRINHO COM DADOS ESPECÍFICOS
    public function AddToCart(Request $request, $id)
    {
        // Achar o produto pelo Model Produto utilizando o id e attribuí à variável $product
        $product = Product::findOrFail($id);

        // Se o produto não tem disconto 
        if ($product->product_discount_price == null) {
            /*
             * pacote bumbummen99/shoppingcart
             * para os interessados...
             * toda lógica carrinho eu tirei da documentação bumbummen99
             * ou seja, para obter um entendimento maior sobre este trabalho
             * leia a documentação encontrada no readme.mk deste projeto.
             */
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->product_selling_price,
                'weight' => 1, // deixei o peso aqui, não é obrigatório... desconsiderar.
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'Produto Adicionado ao Carrinho']);
        } else {
            // Se o produto tem disconto
            // pacote bumbummen99/shoppingcart
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->product_discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'Produto Adicionado ao Carrinho']);
        }
    }

    // MÉTODO PARA ADICIONAR MINICARRINHO HEADER
    public function AddMiniCart()
    {
        // bumbummen99/shoppingcart  
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    }

    // MÉTODO P/ REMOVER ITEM NO MINICARRINHO HEADER
    public function RemoveMiniCart($rowId)
    {
        // bumbummen99/shoppingcart 
        Cart::remove($rowId);
        return response()->json(['success' => 'Produto Removido do Carrinho']);
    }


    // MÉTODO PARA REDIRECIONAR USUÁRIO À PÁGINA CHECKOUT
    public function Checkout()
    {
        // Para prosseguir p/ o checkout, o usuário deve estar autenticado. Se estiver td certo, prosseguir,
        // Caso contrário, notificar e redirecionar para login
        if (Auth::check()) {
            // Se o carrrinho for maior que 0, proceder p/ a página checkout
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                // Models dos Estados. Necessário para manter endereço cliente
                $divisions = ShippingDivision::orderBy('shipping_division_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
                // Se o carrinho estiver vazio e o usuário clickar em 'proceder c/ o checkout'
                // Então, notificar com mensagem de erro e redirecionar para a home.
            } else {

                $notification = array(
                    'message' => 'Adicionar pelo menos um produto',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        } else {

            $notification = array(
                'message' => 'Voce precisa efetuar Login primeiro',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
