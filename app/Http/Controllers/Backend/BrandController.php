<?php

/* IMPORTAR MODEL BRAND */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // MÉTODO PARA VISUALIZAÇÃO DAS MARCAS
    public function BrandView()
    {
        // Pegar os dados mais atuais da table brands pela Model e atribuir à variável $brands
        $brands = Brand::latest()->get();

        // após isso, retornar visualização da pagina brand_view com os dados compactados
        return view('backend.brand.brand_view', compact('brands'));
    }

    // MÉTODO POST PARA GUARDAR OS DADOS DA MARCA
    public function BrandStore(Request $request)
    {
        // Validar os input fields marca e a imagem da marca.
        $request->validate(
            [
                'brand_name_pt' => 'required',
                'brand_image' => 'required',

            ],

            // Customizar as mensagens de erro
            [

                'brand_name_pt.required' => 'Inserir Marca',
                'brand_image.required' => 'Foto da Marca é obrigatório',
            ]
        );

        // Pegar a imagem Marca e a atribuir a variável $image
        $image = $request->file('brand_image');
        // Criar um Id unica para a imagem e pegar a extensão da imagem
        $generate_name = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
        // Gerar a imagem e redimensionar para 150px X 150px e depois salvar na pasta brands 
        Image::make($image)->resize(150, 150)->save('upload/brand_images/' . $generate_name);
        // Salvar a imagem atualizada
        $save_url = 'upload/brand_images/' . $generate_name;

        // Salvar imagem no BD
        Brand::insert([

            'brand_name_pt' => $request->brand_name_pt,

            //Slug, strtolower converte string para minusculo, se tiver espaço, substitui com traço e mostra o nome da marca em inglês
            'brand_slug_pt' => strtolower(str_replace('', '-', $request->brand_name_pt)),

            // Salva a imagem utilzando a variável $save_url
            'brand_image' => $save_url,
        ]);

        // Mensagen toaster para mostrar barra verde com a mensaagem de sucesso
        $notification = array(
            'message' => 'Marca inserida com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina manter marca
        return redirect()->back()->with($notification);
    }

    // MÉTODO PARA EDITAR MARCA
    public function BrandEdit($id)
    {
        // Buscar o Id e atribuit à variável $brand pelo find or fail, que:
        // recebe um id e retorna um único modelo. Se não existir nenhum modelo correspondente, ele gera um erro 404
        $brand = Brand::findOrFail($id);

        // Após buscar a Id e atribuir-à variável $brand(marca), retornar para página editar_marca com os dados da marca compactados
        return view('backend.brand.brand_edit', compact('brand'));
    }

    // MÉTODO POST P/ GUARDAR DADOS MARCA EDITADOS
    public function BrandUpdate(Request $request)
    {

        // Pegar id e atribuir à variável $brand
        $brand_id = $request->id;

        // Pegar Imagem antiga
        $old_image = $request->old_image;

        // Condição: se deseja atualizar imagem, pega a imagem antiga e atualiza
        if ($request->file('brand_image')) {

            // desvincular imagem
            unlink($old_image);

            /* === COPIEI E COLEI A LÓGICA DO MÉTODO BRANDSTORE === */

            // Pegar a imagem Marca e a atribuir a variável $image
            $image = $request->file('brand_image');

            // Criar um Id unica para a imagem e pegar a extensão da imagem
            $generate_name = hexdec(uniqid()) . '.' . $image->getClientOriginalName();

            // Gerar a imagem e redimensionar para 3000px X 300px e depois salvar na pasta brands (marcas)
            Image::make($image)->resize(150, 150)->save('upload/brand_images/' . $generate_name);

            // Salvar a imagem atualizada
            $save_url = 'upload/brand_images/' . $generate_name;

            // Atualizar imagem no BD pelo ID. acha id ou gera erro 404 e, finalmente, atualiza ->update
            Brand::findOrFail($brand_id)->update([

                // Atualizar nome marcas
                'brand_name_pt' => $request->brand_name_pt,

                //Slug, strtolower converte string para minusculo, se tiver espaço, substitui com traço e mostra o nome da marca em inglês
                'brand_slug_pt' => strtolower(str_replace('', '-', $request->brand_name_pt)),

                // Salva a imagem utilzando a variável $save_url
                'brand_image' => $save_url,
            ]);

            // Mensagen toaster para mostrar barra verde com a mensagem de sucesso
            $notification = array(
                'message' => 'Marca atualizada com Sucesso',
                'alert-type' => 'success'
            );

            // Retornar para pagina todas marcas
            return redirect()->route('all.brands')->with($notification);

            // Caso contrário, se não desejar atualizar imagem, atualizar somente o inputfield desejado
        } else {

            /* ===== COPIEI E COLEI A LÓGICA Brand::findOrFail ===== */

            // ATUALIZAR imagem no BD pelo ID. acha id ou gera mens. erro 404 e, finalmente, atualiza ->update
            Brand::findOrFail($brand_id)->update([

                'brand_name_pt' => $request->brand_name_pt,

                //Slug, strtolower converte string para minusculo, se tiver espaço, substitui com traço e mostra o nome da marca em inglês
                'brand_slug_pt' => strtolower(str_replace('', '-', $request->brand_name_pt)),


            ]);

            // Mensagen toaster para mostrar barra verde com a mensagem de sucesso
            $notification = array(
                'message' => 'Marca atualizada com Sucesso',
                'alert-type' => 'success'
            );

            // Retornar para pagina todas marcas
            return redirect()->route('all.brands')->with($notification);
        }      

    }

    // MÉTODO P/ DELETAR MARCA 
    public function BrandDelete($id)
    {
        // Como ja explicado, é necessário pegar o id Marca pelo método findOrFail, pega ou 404 error
        $brand = Brand::findOrFail($id);

        // Acessar a table Brand(marcas), coluna brand_image
        $image = $brand->brand_image;

        // Após isso, desvincular image
        unlink($image);

        // Finalmente, deletar pela função delete().
        Brand::findOrFail($id)->delete();

        // Mostrar notificação (toaster message) de exclusão bem sucedida.
        $notification = array(
            'message' => 'Marca Deletada com Sucesso',
            'alert-type' => 'success'
        );
        // Após exclusão, simplesmente retornar.
        return redirect()->back()->with($notification);
    }
}
