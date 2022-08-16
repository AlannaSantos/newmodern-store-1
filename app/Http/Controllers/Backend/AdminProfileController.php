<?php

/* IMPORTAR MODEL ADMIN */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AdminProfileController extends Controller
{
    // MÉTODO P/ ACESSAR PERFIL ADMIN
    public function AdminProfile()
    {
        // Acessa Admin Model p/ pegar o adm pre-registrado no BD pelo ID (1)
        $adminData = Admin::find(1);
        // Depois retorna view perfil_admin com os dados do administrador atribúido à variável $adminData compactados
        return view('admin.admin_profile_view', compact('adminData'));
    }

    // METODO P/ EDITAR PERFIL ADMIN
    public function AdminProfileEdit()
    {
        // Acessa Admin Model p/ pegar o adm pre-registrado no BD pelo ID (1)
        $editData = Admin::find(1);
        // Depois retorna view perfil_admin com os dados do administrador atribúido à variável $adminData compactados
        return view('admin.admin_profile_edit', compact('editData'));
    }

    // MÉTODO POST P/ SALVAR DADOS ADMIN
    public function AdminProfileStore(Request $request)
    {
        // Acessar table Admin pela Model, e buscar o Admin com id 1 e atribuir esse dado à variável $data
        $data = Admin::find(1);
        // Acessar a coluna nome e atribuir este dado à variável $data
        $data->name = $request->name;
        // Acessar a coluna email e atribuir este dado à variável $data
        $data->email = $request->email;

        // Condição de upload de imagem: se o usuário decidir salvar imagem perfil...
        if ($request->file('profile_photo_path')) {
            // Solicitar/acessar o arquivo e caminho do mesmo
            $file = $request->file('profile_photo_path');
            // Salvar apenas a foto atual
            @unlink(public_path('upload/admin_images/' . $data->profile_photo_path));
            // Salvar arquivo em upload/admin_images pelo nome e extensão da imagem
            $filename = date('Ymdhi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            // Subir dado no BD
            $data['profile_photo_path'] = $filename;
        }
        // Salvar dado no BD
        $data->save();

        // Mensagen toaster para mostrar barra verde com a mensaagem de sucesso
        $notification = array(
            'message' => 'Perfil Adminstrador Alterada com Sucesso',
            'alert-type' => 'success'
        );

        // Retornar para pagina perfil
        return redirect()->route('admin.profile')->with($notification);
    }

    // MÉTODO PARA MUDAR SENHA MANTENEDOR
    public function AdminChangePassword()
    {
        // Apenas retorna a view mudar senha admin
        return view('admin.admin_change_password');
    }

    // MÉTODO PARA ATUALIZAR SENHA ALTERADA MANTENEDOR
    public function  AdminUpdateChangePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Pega a senha criptografada do mantenedor e salva na variável $hashedPassword
        $hashedPassword = Admin::find(1)->password;

        /*CONDIÇÃO: SE O MANTENEDOR REQUISITAR MUDANÇA DE SENHA , REALIZAR: */

        // verificar se a senha é compativel com a senha salva no BD | Hash::check é uma função nativa do Laravel */
        if (Hash::check($request->oldpassword, $hashedPassword)) {

            // Pega os dados admin (Senha) pelo id 1 e armazena na variavél $admin
            $admin = Admin::find(1);

            // Acessa o campo 'password' no BD com a variável $admin e cria uma senha HASH
            $admin->password = Hash::make($request->password);

            // Salvar dado
            $admin->save();

            // Após salvar dado, o mantendeor autenticado é redirecionado para logout
            Auth::logout();

            // Após logout, mantenedor é redirecionado para página logout
            return redirect()->route('admin.logout');
        }

        /*CONDIÇÃO: CASO CONTRÁRIO, REDIRECIONAR PARA PÁGINA ANTERIOR */ 
        else {
            return redirect()->back();
        }
    }
}
