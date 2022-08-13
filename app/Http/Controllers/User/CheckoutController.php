<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Método Ajax p/ pegar os dados estado/cidade do BD 
    public function DistrictGetAjax($shipping_division_id)
    {
        // Buscar os nomes em orden decrescente da table shipping_division (estado) e atribui-los à variável $shipping
        $shipping = ShippingDistrict::where('shipping_division_id', $shipping_division_id)->orderBy('shipping_district_name', 'ASC')->get();
        // Após atribuição, retornar os dados em formato json, como consta no JS Ajax script.
        return json_encode($shipping);
    }


    /**
     * Método p/ guardar os dados do cliente na variável $data ao realizar o processo de compraItem
     * após a atribuição, retornar pagina (view) processo pagamento (cartão/stripe/ Paypal ou espécie)
     * como trata-se de trabalho acedemico, não mostrarei na apresentaçao o Stripe e PayPal, 
     * somente pagamento em espécie. Farei isto pois APIs de pagamento envolvem chaves secretas e conta pessoal.
     */
    public function CheckoutStore(Request $request)
    {

        $data = array();
        $data['shipping_division_id'] = $request->shipping_division_id;
        $data['shipping_district_id'] = $request->shipping_district_id;
        $data['name'] = $request->name;
    	$data['email'] = $request->email;
    	$data['phone'] = $request->phone;
        $data['postal_code'] = $request->postal_code;
        $data['shipping_street'] = $request->shipping_street;
        $data['shipping_number'] = $request->shipping_number;
        $data['shipping_hood'] = $request->shipping_hood;
        $data['notes'] = $request->notes;
        // função tirado do pacote bumbummen99/shopping cart. (literalmente, copiei e colei | é simples)
        $cartTotal = Cart::total();

        // Se o cliente clickar em pagamento cartão, retorna view Stripe
        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        } elseif ($request->payment_method == 'card') {
            return 'card';
        // Ou retorna view espécie , se o cliente clickar em pagamento espécie
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    }
}
