<?php

# =============================== IMPORTAR TODAS AS CONTROLLERS AQUI ==================================== #

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SupplierController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;


use App\Http\Controllers\User\AllUsersController;
use App\Http\Controllers\User\MyCartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CashController;



use Illuminate\Support\Facades\Route;



# ========================================  HOME SEM MIDDLEWARE ========================================= #

Route::get('/', [IndexController::class, 'index'])->name('index');



# =====================================  ROTAS SEM MIDDLEWARE ADMIN ===================================== #

Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});


# ============================ TODAS AS ROTAS ADMIN PROTEGIDAS C/ MIDDLEWARE ============================ #


Route::middleware([
    'auth:sanctum,admin', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');

    // Rota para logout do Admin
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    // Rota para manter perfil Admin
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

    // Rota para entrar em editar perfil Admin
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

    // Rota que aceita os dados anexados no corpo da mensagem de requisição para armazenamento [POST admin.edit.profile]
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

    // Rota para mudar senha Admin
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

    // Rota que aceita as mudanças senha Admin
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
});




# =========================== TODAS AS ROTAS USUARIO PROTEGIDAS C/ MIDDLEWARE =========================== #


// login, registration, email verification, two-factor authentication, session management 
Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        return view('dashboard');
    });

    // Rota Usuario [LOGOUT] - rota para logout do usuario
    Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

    // Rota Usuario [PROFILE - PERFIL] - rota p/ acessar a pagina perfil usuario
    Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

    // Rota Usuario [PROFILE - PERFIL] - rota p/ guardar dados perfil usuario editados pelo mesmo
    Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

    // Rota Usuario [PASSWORD] - rota p/ acessar página mudar senha usuario
    Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');

    // Rota Usuario [PASSWORD] - rota p/ guardar senha alterado pelo usuario
    Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');
});




# =============================== TODAS AS ROTAS CRUD MARCAS PAINEL ADMIN ============================== #

/*** prefix siginica que aparecerá o objeto na url antes da rota chamada: (brand/view ; brand/store; ...) */
Route::prefix('brand')->group(function () {

    // Rota p/ visualizar a tabela de Marcas no Painel Admin.
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brands');

    // Rota p/ guardar informações Marcas no Painel Admin
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

    // Rota p/ editar Marca
    Route::get('/edit{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');

    // Rota p/ guardar inforções EDITADAS Marcas no Painel Admin
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');

    // Rota p/ deletar Marca
    Route::get('/delete{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});



# ============================ TODAS AS ROTAS CRUD CATEGORIA PAINEL ADMIN ============================== #

Route::prefix('category')->group(function () {

    // Rota p/ visualizar a tabela de Categorias no Painel Admin.
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.categories');

    // Rota p/ guardar informações Categorias no Painel Admin
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

    // Rota p/ editar Categoria
    Route::get('/edit{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

    // Rota p/ guardar inforções EDITADAS Categoria no Painel Admin
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

    // Rota p/ deletar Categoria
    Route::get('/delete{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');



    # ========================= TODAS AS ROTAS CRUD SUBCATEGORIA PAINEL ADMIN ========================== #

    // Rota p/ visualizar a tabela de SubCategorias no Painel Admin.
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategories');

    // Rota p/ guardar informações SubCategorias no Painel Admin
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

    // Rota p/ editar SubCategoria
    Route::get('/sub/edit{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

    // Rota p/ guardar inforções EDITADAS SubCategoria no Painel Admin
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

    // Rota p/ deletar SubCategoria
    Route::get('/sub/delete{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');



    # ========================== TODAS AS ROTAS CRUD SUBSUBCATEGORIA PAINEL ADMIN ====================== #

    // Rota p/ visualizar a tabela de SubCategorias no Painel Admin.
    Route::get('/sub/sub/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategories');

    // Rota para pegar a  URL definida no js em subsubcategory_view.blade.php: ROTA JS-AJAX p/ mostrar categoria com a subcategoria dinamicamente
    Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);

    // Rota para pegar a  URL definida no js em subsubcategory_view.blade.php: ROTA JS-AJAX p/ mostrar subcategoria com a subsubcategoria dinamicamente
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);

    // Rota p/ guardar informações SubCategorias no Painel Admin
    Route::post('/sub/sub/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

    // Rota p/ editar SubCategoria
    Route::get('/sub/sub/edit{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

    // Rota p/ guardar inforções EDITADAS SubCategoria no Painel Admin
    Route::post('/sub/sub/update', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

    // Rota p/ deletar SubCategoria
    Route::get('/sub/sub/delete{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
});



# ================================ TODAS AS ROTAS PRODUTO PAINEL ADMIN ================================== #

/*** prefix siginica que aparecerá o objeto na url antes da rota chamada: (product/view ; product/store; ...) */
Route::prefix('product')->group(function () {

    // Rota p/ visualizar o formulário adicionar produto no Painel Admin.
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('product.add');

    // Rota p/ adicionar produtos no Painel Admin.
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');

    // Rota p/ a pagina gerenciar produtos no Painel Admin.
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('product.manage');

    // Rota p/ editar produtos no Painel Admin.
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');

    // Rota p/ validar os campos editados produtos no Painel Admin.
    Route::post('/update', [ProductController::class, 'UpdateProduct'])->name('product.update');

    // Rota p/ validar as imagens produtos editadas no Painel Admin.
    Route::post('/update/image', [ProductController::class, 'UpdateProductImage'])->name('product.update.image');

    // Rota p/ deletar Imagem Produto
    Route::get('/delete/image{id}', [ProductController::class, 'DeleteProductImage'])->name('product.delete.image');

    // Rota p/ validar as imagens produtos editadas no Painel Admin.
    Route::post('/update/thumbnail', [ProductController::class, 'UpdateProductThumbnail'])->name('product.update.thumbnail');

    // Rota p/ inativar produto no painel admin edit product
    Route::get('/inactivate/{id}', [ProductController::class, 'InactivateProduct'])->name('product.inactivate');

    // Rota p/ ativar produto no painel admin edit product
    Route::get('/activate/{id}', [ProductController::class, 'ActivateProduct'])->name('product.activate');

    // Rota p/ deletar produto no painel admin edit product
    Route::get('/delete/{id}', [ProductController::class, 'DeleteProduct'])->name('product.delete');
});

# ====================================== TODAS AS ROTAS FORNECEDOR ======================================= #


Route::prefix('suppliers')->group(function () {

    Route::get('/view', [SupplierController::class, 'SupplierView'])->name('all.suppliers');


    Route::post('/store', [SupplierController::class, 'SupplierStore'])->name('supplier.store');


    Route::get('/edit{id}', [SupplierController::class, 'SupplierEdit'])->name('supplier.edit');


    Route::post('/update', [SupplierController::class, 'SupplierUpdate'])->name('supplier.update');


    Route::get('/delete{id}', [SupplierController::class, 'SupplierDelete'])->name('supplier.delete');
});



# ========================================= ROTA ESTOQUE VIEW ========================================== #

Route::prefix('stock')->group(function () {

    Route::get('/view', [ProductController::class, 'StockView'])->name('product.stock');
});





# =================================== TODAS AS ROTAS FRONT-END ========================================= #


// Rota p/ detalhes do produto - como usei url, não é necessário nomear a rota
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Rota p/ detalhes do produto ao clickar em sua subsubcategoria - como usei url, não é necessário nomear a rota
Route::get('/subcategory/product/{id}/{slug}', [IndexController::class, 'ProductSubDetails']);

// Rota p/ detalhes do produto ao clickar em sua subsubcategoria - como usei url, não é necessário nomear a rota
Route::get('/subsubcategory/product/{id}/{slug}', [IndexController::class, 'ProductSubSubDetails']);

// Rota AJAX p/ pegar os dados do produto onClick, em formato json, e passar para a bootstrap modal ao clickar no botão carrinho
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);




# ======================================== TODAS AS ROTAS CARRINHO ===================================== #

// Rota AJAX p/ pegar os dados do produto onClick, em formato json, e passar para a bootstrap modal ao clickar no botão carrinho
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Rota AJAX Pegar dados mini carrinho - como usei url, não é necessário nomear a rota
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);

// ROTA AJAX Remover dados mini carrinho - como usei url, não é necessário nomear a rota
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);




# ================ PROTEGER AS PÁGINAS VIEWS: PAGAMENTOS e PEDIDOS COM MIDDLEWARE ================ #

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {


    // Rota Pagamento via ESPÉCIE
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    // Rota p/ acessar view page meus pedidos (pedido de usuário autenticado)
    Route::get('/my/orders', [AllUsersController::class, 'MyOrders'])->name('my.orders');

    // Rota p/ acessar view page detalhes de um produto especifico
    Route::get('/order_details/{order_id}', [AllUsersController::class, 'OrderDetails']);

    // Rota p/ baixar boleto/invoice
    Route::get('/invoice_download/{order_id}', [AllUsersController::class, 'InvoiceDownload']);
});



# ====================================== TODAS AS ROTAS MEU CARRINHO ==================================== #

// Rota Meu Carrinho View Page.
Route::get('/mycart', [MyCartController::class, 'MyCart'])->name('mycart');

// Rota AJAX adicionar Itens na view Meu Carrinho. URL
Route::get('/user/get-cart-product', [MyCartController::class, 'GetCartProduct']);

// Rota AJAX excluir Itens na view Meu Carrinho. URL
Route::get('/user/cart-remove/{rowId}', [MyCartController::class, 'RemoveCartProduct']);

// Rota AJAX incrementar Itens na view Meu Carrinho. URL
Route::get('/cart-increment/{rowId}', [MyCartController::class, 'CartProductIncrement']);

// Rota AJAX decrementar Itens na view Meu Carrinho. URL
Route::get('/cart-decrement/{rowId}', [MyCartController::class, 'CartProductDecrement']);



# ==================================== TODAS AS ROTAS ADMIN ENVIO ============================== #

// prefixo shipping (envio) toda rota terá esse objeto (ação enviar) no início da URL
Route::prefix('shipping')->group(function () {

    # ============================= TODAS AS ROTAS ADMIN SHIPPING/ENVIO - ESTADO ======================== #

    // Rota p/ a view Bairro Envio
    Route::get('/division/view', [ShippingController::class, 'ShippingDivisionView'])->name('division.manage');

    // Rota p/ guardar dados Bairro Envio
    Route::post('/division/store', [ShippingController::class, 'ShippingDivisionStore'])->name('division.store');

    // Rota p/ editar Bairro Envio
    Route::get('/division/edit/{id}', [ShippingController::class, 'ShippingDivisionEdit'])->name('division.edit');

    // Rota p/ atualizar Bairro Envio
    Route::post('/division/update/{id}', [ShippingController::class, 'ShippingDivisionUpdate'])->name('division.update');

    // Rota p/ excluir Bairro Envio
    Route::get('/division/delete/{id}', [ShippingController::class, 'ShippingDivisionDelete'])->name('division.delete');


    # =========================== TODAS AS ROTAS ADMIN SHIPPING/ENVIO - CIDADE  ======================== #

    // Rota p/ a view Cidade Envio
    Route::get('/district/view', [ShippingController::class, 'ShippingDistrictView'])->name('district.manage');

    // Rota p/ guardar dados Cidade Envio
    Route::post('/disctrict/store', [ShippingController::class, 'ShippingDistrictStore'])->name('district.store');

    // Rota p/ editar Cidade Envio
    Route::get('/district/edit/{id}', [ShippingController::class, 'ShippingDistrictEdit'])->name('district.edit');

    // Rota p/ atualizar Cidade Envio
    Route::post('/district/update/{id}', [ShippingController::class, 'ShippingDistrictUpdate'])->name('district.update');

    // Rota p/ excluir Cidade Envio
    Route::get('/district/delete/{id}', [ShippingController::class, 'ShippingDistrictDelete'])->name('district.delete');
});


# ======================================= TODAS AS ROTAS CHECKOUT ======================================= #

// Rota proceder checkout
Route::get('/checkout', [CartController::class, 'Checkout'])->name('checkout');

// Rota Ajax p/ pegar dinamicamente os dados Cidade relacionados aos estados
Route::get('/district-get/ajax/{shipping_division_id}', [CheckoutController::class, 'DistrictGetAjax']);

// Rota p/ guardar dados formulário endereço
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');
