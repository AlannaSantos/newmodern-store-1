<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;


class MyCartController extends Controller
{
    // MÉTODO RETORNAR VIEW MYCART
    public function MyCart()
    {   
        // Apenas retorna a view meu-carrinho
        return view('frontend.cart.view_mycart');
    }

    // MÉTODO AJAX P/ PEGAR PRODUTO E ENVIAR AO MEU CARRINHO
    public function GetCartProduct()
    {
        // bumbummen99/shoppingcart: conteúdo-carrinho; quantidade-itens e total-carrinho  
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        // Após pegar os dados e atribuí-los às variáveis acima, retorna Json com os dados das variáveis
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    }

    // MÉTODO AJAX P/ EXCLUIR PRODUTO MEU CARRINHO
    public function RemoveCartProduct($rowId)
    {
        
        // Copiei essa função da documentação pacote bumbummen99/shoppingcart
        Cart::remove($rowId);
        
        // Após remover pela função do pacote bumbummen, retorna msg.
        return response()->json(['success' => 'Produto removido com Sucesso']);
    }

    // MÉTODO P/ INCREMENTAR ITEM-MEU-CARRINHO
    public function CartProductIncrement($rowId)
    {
        // Pegar a variável $row e passar a Id nela utilizando a função get do pacote...
        $row = Cart::get($rowId);

        // Função tirada do pacote bumbummen99/shopppingcart, pegar a variável e adicionar um na qty
        Cart::update($rowId, $row->qty + 1);

        // Retorna toaster message
        return response()->json('Produto incrementado com Sucesso');
    }

    // MÉTODO AJAX DECREMENTAR ITEM-MEU-CARRINHO
    public function CartProductDecrement($rowId)
    {
        // Pegar a variável $row e passar a Id nela utilizando a função get do pacote...
        $row = Cart::get($rowId);

        // Função tirada do pacote bumbummen99/shopppingcart, pegar a variável e dimunir um na qty 
        Cart::update($rowId, $row->qty - 1);

        // Retorna toaster message
        return response()->json('Produto decrementado com Sucesso');
    }
}
