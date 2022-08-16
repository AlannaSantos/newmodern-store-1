<?php

/**
 * IMPORTAR MODELS SUBCATEGORY e MODELS CATEGORY DEVIDO A FK CATEGORY 
 * COPIE E COLEI A MESMA LÓGICA UTILIZADA NA CRUD CATEGORY 
 */

namespace App\Http\Controllers\Backend;

use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // MÉTODO P/ RETORNAR VIEW SUBCATEGORIA
    public function SubCategoryView()
    {
        // Pegar os dados categoria ordenado em ordem crescente pelo nome em inglês
        $categories = Category::orderBy('category_name_pt', 'ASC')->get();

        // Pegar os dados mais atuais da table brands(categories) pela Model e atribuir à variável $category
        $subcategories = SubCategory::latest()->get();

        // Retorna a view, localizada em resources/views/backend/category/subcategory_view.blade.php com os dados das variáveis sub e categories
        return view('backend.subcategory.subcategory_view', compact('subcategories', 'categories'));
    }

    // MÉTODO POST P/ GUARDAR DADOS CATEGORIA NO BD 
    public function SubCategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required',
                'subcategory_name_pt' => 'required',
            ],


            // Customizar as mensagens de erro
            [
                'category_id.required' => 'Selecione qualquer opção',
                'subcategory_name_pt.required' => 'Inserir Sub-Categoria',

            ]
        );

        // Salvar imagem no BD
        SubCategory::insert([

            // FK category   
            'category_id' => $request->category_id,
            'subcategory_name_pt' => $request->subcategory_name_pt,

            //Slug: deixar o BD mais organizado; strtolower converte string para minusculo, se tiver espaço, substitui com traço
            'subcategory_slug_pt' => strtolower(str_replace('', '-', $request->subcategory_name_pt)),

        ]);

        // Mensagen toaster para mostrar barra verde com a mensaagem de sucesso
        $notification = array(
            'message' => 'Sub-Categoria inserida com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina anterior
        return redirect()->back()->with($notification);
    }

    // MÉTODO PARA EDITAR CATEGORIA
    public function SubCategoryEdit($id)
    {
        // Pegar os dados categoria ordenado em ordem crescente pelo nome em inglês
        $categories = Category::orderBy('category_name_pt', 'ASC')->get();

        // Buscar o Id e atribuir à variável $subcategory pelo find or fail, que:
        // recebe um id e retorna um único modelo. Se não existir nenhum modelo correspondente, ele gera um erro 404
        $subcategory = SubCategory::findOrFail($id);

        // Após buscar a Id e atribuir-à variável $subcategory, retornar para página editar subcategorias com os dados das variáveis compactadas
        return view('backend.subcategory.subcategory_edit', compact('subcategory', 'categories'));
    }

    // MÉTODO POST P/ GUARDAR OS DADOS EDITADOS DA SUBCATEGORIA
    public function SubCategoryUpdate(Request $request)
    {
        // Pegar id e atribuir à variável $subcategory_id
        $subcategory_id = $request->id;

        // Atualizar dados no BD
        SubCategory::findOrFail($subcategory_id)->update([

            // FK category   
            'category_id' => $request->category_id,
            'subcategory_name_pt' => $request->subcategory_name_pt,

            //Slug: deixar o BD mais organizado; strtolower converte string para minusculo, se tiver espaço, substitui com traço
            'subcategory_slug_pt' => strtolower(str_replace('', '-', $request->subcategory_name_pt)),

        ]);


        // Mensagen toaster para mostrar barra verde com a mensagem de sucesso
        $notification = array(
            'message' => 'Sub-Categoria atualizada com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina todas subcategorias
        return redirect()->route('all.subcategories')->with($notification);
    }

    // MÉTODO PARA EXCLUIR CATEGORIA PELO ID
    public function SubCategoryDelete($id)
    {

        // deletar após achar categoria pelo Id.
        SubCategory::findOrFail($id)->delete();

        // Mostrar notificação (toaster message) de exclusão bem sucedida.
        $notification = array(
            'message' => 'Sub-Categoria Excluída com Sucesso',
            'alert-type' => 'success'
        );
        // Após exclusão, simplesmente retornar.
        return redirect()->back()->with($notification);
    }
}
