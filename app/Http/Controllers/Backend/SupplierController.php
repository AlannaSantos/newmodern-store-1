<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function SupplierView()
    {

        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_view', compact('suppliers'));
    }

    public function SupplierStore(Request $request)
    {

        $request->validate(
            [

                'supplier_name' => 'required',
                'supplier_company' => 'required',
                'supplier_phone' => 'required',

            ],


            [
                'supplier_name' => 'Inserir Nome do Fornecedor',
                'supplier_company' => 'Inserir Razão Social',
                'supplier_phone' => 'Inserir Telefone do Fornecedor',

            ]
        );


        Supplier::insert([

            'supplier_name' => $request->supplier_name,
            'supplier_company' => $request->supplier_company,
            'supplier_phone' => $request->supplier_phone,


        ]);


        $notification = array(
            'message' => 'Fornecedor inserido com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function SupplierEdit($id)
    {

        $suppliers = Supplier::findOrFail($id);

        return view('backend.supplier.supplier_edit', compact('suppliers'));
    }


    public function SupplierUpdate(Request $request)
    {

        $suppliers = $request->id;

        Supplier::findOrFail($suppliers)->update([

            'supplier_name' => $request->supplier_name,
            'supplier_company' => $request->supplier_company,
            'supplier_phone' => $request->supplier_phone,

        ]);

        $notification = array(
            'message' => 'Fornecedor atualizado com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->route('all.suppliers')->with($notification);
    }


    public function SupplierDelete($id)
    {

        $suppliers = Supplier::findOrFail($id);


        Supplier::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Fornecedor Excluído com Sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
