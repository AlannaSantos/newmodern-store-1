<?php

/* IMPORTAR MODEL CATEGORY */
/* COPIE E COLEI A MESMA LÓGICA UTILIZADA NA CRUD BRANDS(marcas) */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Método p/ visualização das categorias
    public function CategoryView()
    {
        // Pegar os dados mais atuais da table Category(categories) pela Model e atribuir à variável $categories
        $categories = Category::latest()->get();
        // Retorna a view, localizada em resources/views/backend/category/category_view.blade.php com os dados da variável $categories compactados
        return view('backend.category.category_view', compact('categories'));
    }

    // Método POST p/ guardar dados categoria no BD 
    public function CategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_name_pt' => 'required',
            ],

            // Customizar as mensagens de erro
            [
                'category_name_pt.required' => 'Inserir Categoria',
            ]
        );

        // Salvar imagem no BD
        Category::insert([

            'category_name_pt' => $request->category_name_pt,
            //Slug, strtolower converte string para minusculo, se tiver espaço, substitui com traço e mostra o nome da marca em inglês
            'category_slug_pt' => strtolower(str_replace('', '-', $request->category_name_pt)),

        ]);

        // Mensagen toaster para mostrar barra verde com a mensagem de sucesso
        $notification = array(
            'message' => 'Categoria inserida com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina category_view com notificação
        return redirect()->back()->with($notification);
    }

    // Método para editar categoria
    public function CategoryEdit($id)
    {
        // Buscar o Id e atribuir à variável $category pelo find or fail, que:
        // recebe um id e retorna um único modelo. Se não existir nenhum modelo correspondente, ele gera um erro 404
        $category = Category::findOrFail($id);

        // Após buscar a categoria pelo id e atribuir à variável $category, retornar para página editar categoria com os dados da variável compactados;
        return view('backend.category.category_edit', compact('category'));
    }

    // Método para guardar os dados editados da categoria, POST = (Request $request)
    public function CategoryUpdate(Request $request)
    {
        // Pegar id e atribuir à variável $category_id
        $category_id = $request->id;

        // Atualizar dados categoria no BD pelo ID. acha id ou gera mens. erro 404 e atualiza ->update
        Category::findOrFail($category_id)->update([

            'category_name_pt' => $request->category_name_pt,
            'category_slug_pt' => strtolower(str_replace('', '-', $request->category_name_pt)),


        ]);

        // Mensagen toaster para mostrar barra verde com a mensagem de sucesso
        $notification = array(
            'message' => 'Categoria atualizada com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina todas categorias
        return redirect()->route('all.categories')->with($notification);
    }

    // Método para excluir categoria pelo id
    public function CategoryDelete($id)
    {
        // Como ja explicado, é necessário pegar o id Categoria pelo método findOrFail, pega ou 404 error
        $category = Category::findOrFail($id);

        // deletar após achar categoria pelo Id.
        Category::findOrFail($id)->delete();

        // Mostrar notificação (toaster message) de exclusão bem sucedida.
        $notification = array(
            'message' => 'Categoria Excluída com Sucesso',
            'alert-type' => 'success'
        );
        // Após exclusão, simplesmente retornar.
        return redirect()->back()->with($notification);
    }
}
