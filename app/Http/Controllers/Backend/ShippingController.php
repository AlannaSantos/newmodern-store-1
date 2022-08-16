<?php

/**
 * CONTROLADOR ENVIO:
 * AQUI FOI UMA TENTATIVA DE IMPLEMENTAR
 * LÓGICA CORREIOS SEM COSUMIR O WEB-SERVICE
 * OU SEJA, MINHA IDEIA ERA RELACIONAR BAIRROS À CIDADES E ESTADOS.
 * NÃO CONSEGUI IMPLEMENTAR 100%, APENAS CIDADES E ESTADOS.
 * APÓS IMPLEMENTAÇÃO DO CONTROLLER E RELACIONAMENTO MODEL
 * CHAMEI ESSES DADOS VIA JAVASCRIPT, OU SEJA, AO SELECIONAR ESTADO NO SELECT FORM ENVIO PRODUTO
 * APARECE, DINAMICAMENTE, TODAS AS CIDADES REFERENTES AO ESTADO SELECIONADO PELO USUARIO.
 * ESSA RELAÇÃO É GUARDADA NA SESSÃO USUARIO E SERVIRÁ, FUTURAMENTE, COMO PARTE DE ENDEREÇO ENVIO
 * 
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingDistrict;
use App\Models\ShippingDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShippingController extends Controller
{

    // MÉTODO VIEW ESTADO ENVIO
    public function ShippingDivisionView()
    {
        // Atribuir id da Model Shipping à variável $shipping
        $divisions = ShippingDivision::orderBy('id', 'DESC')->get();
        // Após a atribuição... retorna página view
        return view('backend.shipping.division.division_view', compact('divisions'));
    }

    // MÉTODO GUARDAR ESTADO ENVIO
    public function ShippingDivisionStore(Request $request)
    {
        // Validar o nome Estado 
        $request->validate([
            'shipping_division_name' => 'required',

        ]);

        // Inserir o nome Estado
        ShippingDivision::insert([

            'shipping_division_name' => $request->shipping_division_name,
            'created_at' => Carbon::now(),

        ]);

        // Retornar toastr msg após inserção Bairro bem sucedida
        $notification = array(
            'message' => 'Estado Inserido com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    // MÉTODO P/ EDITAR ESTADO
    public function ShippingDivisionEdit($id)
    {
        // Achar or retornar 404 id shipping division (bairro) e atribuir à variável $divisions
        $divisions = ShippingDivision::findOrFail($id);
        // Após a atribuição, retornar a páginaa view editar Bairro
        return view('backend.shipping.division.division_edit', compact('divisions'));
    }


    // MÉTODO P/ GUARDAR DADOS BAIRRO EDITADOS (COPIEI E COLEI A MESMA LÓGICA DO SHIPP...STORE)
    public function ShippingDivisionUpdate(Request $request, $id)
    {

        ShippingDivision::findOrFail($id)->update([

            'shipping_division_name' => $request->shipping_division_name,
            'created_at' => Carbon::now(),

        ]);

        // Retornar toastr msg após inserção Bairro bem sucedido
        $notification = array(
            'message' => 'Estado Atualizado com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('division.manage')->with($notification);
    }

    // MÉTODO P/ EXCLUIR ESTADO
    public function ShippingDivisionDelete($id)
    {
        // Chamar a model, achar pelo o id e passar a função excluir (delete();)
        ShippingDivision::findOrFail($id)->delete();

        //Após achar pelo id  e excluir utilzando a função, passar a toastr msg na view Bairro...
        $notification = array(
            'message' => 'Estado excluído com Sucesso',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    // MÉTODO VIEW CIDADE ENVIO
    public function ShippingDistrictView()
    {
       
        $divisions = ShippingDivision::orderBy('shipping_division_name', 'ASC')->get();
        $districts = ShippingDistrict::with('division')->orderBy('id', 'DESC')->get();
      
        return view('backend.shipping.district.district_view', compact('districts', 'divisions'));
    }

   
    public function ShippingDistrictStore(Request $request)
    {
    
        $request->validate([

            'shipping_district_name' => 'required',
            'shipping_division_id' => 'required',

        ]);

      
        ShippingDistrict::insert([

            'shipping_district_name' => $request->shipping_district_name,
            'shipping_division_id' => $request->shipping_division_id,
            'created_at' => Carbon::now(),

        ]);

     
        $notification = array(
            'message' => 'Cidade Inserida com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

  
    public function ShippingDistrictEdit($id)
    {

        $divisions = ShippingDivision::orderBy('shipping_division_name', 'ASC')->get();
        $districts = ShippingDistrict::findOrFail($id);
        return view('backend.shipping.district.district_edit', compact('divisions', 'districts'));
    }

   
    public function ShippingDistrictUpdate(Request $request, $id)
    {

        ShippingDistrict::findOrFail($id)->update([

            'shipping_division_id' => $request->shipping_division_id,
            'shipping_district_name' => $request->shipping_district_name,
            'created_at' => Carbon::now(),
        ]);

       
        $notification = array(
            'message' => 'Cidade Atualizada com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('district.manage')->with($notification);
    }

 
    public function ShippingDistrictDelete($id)
    {
    
        ShippingDistrict::findOrFail($id)->delete();

       
        $notification = array(
            'message' => 'Cidade excluída com Sucesso',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
