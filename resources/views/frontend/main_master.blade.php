<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ====== SEGURANÇA CSRF: CROSS SITE REFERENCING FORGERY ====== -->
    <meta name="NewModern Team" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <!-- ========================== FAVICON ============================ -->
    <link rel="icon" href="{{ asset('backend/images/favicon-new.ico') }}">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Toaster Stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Stripe Payment Script PAGAMENTO CARTAO CREDITO -->
    <script src="https://js.stripe.com/v3/"></script>

</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->

    @include('frontend.body.header')
    <!-- Chamar o HEADER. Assim todas as páginas terão mesmo conteúdo HEADER |**FRAGMENTAÇÃO** -->

    <!-- ============================================== CONTENT ============================================== -->

    <!-- yield('content') é onde fica o conteúdo (que muda de página p/ pagina) -->

    @yield('content')

    <!-- =============================================  FOOTER =============================================== -->

    @include('frontend.body.footer')
    <!-- Chamar o FOOTER. Assim todas as páginas terão mesmo conteúdo footer | **FRAGMENTAÇÃO** -->



    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>



    <!-- =================== SWEET ALERT =================== -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ============== TOASTER MESSAGE ADMIN ============== -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {

                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;

            }
        @endif
    </script>

    <!-- ============ MODAL BOOTSTRAP ADICIONAR PRODUTO NO CARRINHO ============  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span> </strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card" style="width: 18rem;">

                                <img src=" " class="card-img-top" alt="..."
                                    style="height: 200px; width: 200px;" id="pimage">

                            </div>

                        </div>


                        <div class="col-md-4">

                            <ul class="list-group">

                                <!-- ====== PREÇO ====== -->
                                <li class="list-group-item">

                                    Preço Produto:

                                    <strong class="text-danger">R$<span id="pprice"></span></strong>
                                    <del id="oldprice">R$</del>
                                </li>

                                <!-- ====== CÓDIGO PRODUTO ====== -->
                                <li class="list-group-item">

                                    Código do Produto:

                                    <strong id="pcode"></strong>
                                </li>

                                <!-- ====== CATEGORIA ====== -->
                                <li class="list-group-item">

                                    Categoria:

                                    <strong id="pcategory"></strong>
                                </li>

                                <!-- ====== MARCA ====== -->
                                <li class="list-group-item">

                                    Marca:

                                    <strong id="pbrand"></strong>
                                </li>

                                <!-- ====== ESTOQUE ====== -->
                                <li class="list-group-item">

                                    Estoque:

                                    <span class="badge badge-pill badge-success" id="aviable"
                                        style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout"
                                        style="background: red; color: white;"></span>

                                </li>

                            </ul>

                        </div>


                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="color">

                                    Escolha a Cor

                                </label>
                                <select class="form-control" id="color" name="color">


                                </select>
                            </div>


                            <div class="form-group" id="sizeArea">
                                <label for="size">

                                    Escolha o Tamanho

                                </label>
                                <select class="form-control" id="size" name="size">
                                    <option>1</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">

                                    Quantidade

                                </label>
                                <input type="number" class="form-control" id="qty" value="1"
                                    min="1">
                            </div>

                            <input type="hidden" id="product_id">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">

                                Adicionar

                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- chamar o csrf para prevenir ataques cross site REFERENCING
    eu tirei este código deste forum: 
    https://www.edureka.co/community/65251/how-to-pass-csrf-token-with-ajax-request-in-laravel
    é ncessário, portanto, realizar este setup e declarar o token em 
    <head><meta name="csrf-token" content="{{ csrf_token() }}"> </head> --}}

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // AJAX View Produto com Bootstrap Modal 
        function productView(id) {
            // Id toaster msg (alert)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {

                    $('#pname').text(data.product.product_name_pt);
                    $('#price').text(data.product.product_selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name_pt);
                    $('#pbrand').text(data.product.brand.brand_name_pt);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                    $('#product_id').val(id);
                    $('#qty').val(1);

                    // Preço Produto
                    if (data.product.product_discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.product_selling_price);
                    } else {
                        $('#pprice').text(data.product.product_discount_price);
                        $('#oldprice').text(data.product.product_selling_price);
                    }

                    // Estoque
                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('disponível');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('esgotado');
                    }

                    // Cor
                    $('select[name="color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + ' ">' + value +
                            ' </option>')
                    })

                    // Tamanho se tiver tamanho, mostrar, caso contrário, esconder select field tamanho
                    $('select[name="size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + ' ">' + value +
                            ' </option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    })

                }
            })
        }

        // função onclick: addToCart()  adiciona o produto sem ter que 'carregar' a página novamente
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart()
                    $('#closeModel').click();

                    // Toaster msg
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }

                }
            })
        }
    </script>


    <!-- ========================  MINI CARRINHO HEADER AJAX ========================  -->
    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);
                    var miniCart = ""
                    $.each(response.carts, function(key, value) {
                        miniCart +=
                            `<div class="cart-item product-summary">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="image"> 
                                        <a href="detail.html"><img src="/${value.options.image}" alt=""></a> 
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                        <div class="price"> ${value.price} * ${value.qty} </div>
                                </div>
                                    <div class="col-xs-1 action"> 
                                        <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)">
                                            <i class="fa fa-trash"></i>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                        <hr>`
                    });

                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        // Função Remover Item Carrinho 
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product-remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }
    </script>


    <!-- ===========================  MEU CARRINHO AJAX ==========================  -->
    <script type="text/javascript">
        // Função adiciona o produto sem ter que 'carregar' a página novamente -AJAX serve p/ isso...
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/user/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows +=
                            `<tr>
                            <td class="col-md-2"><img src="/${value.options.image} "alt="imga"
                                style="width:; height:"></td>
                                <td class="col-md-2">
                                    <div class="product-name"><a href="#">${value.name}</a></div>
                        
                                    <div class="price">
                                        ${value.price}
                                    </div>
                                </td>

                                <td class="col-md-2">
                                    ${value.options.color == null
                                        ?   `<span>
                                                                                   
                                                                                   
                                                        </span>`
                                        :`<strong>${value.options.color}</strong>`
                                    }   

                                </td>

                                <td class="col-md-2">
                                    ${value.options.size == null
                                        ? `<span>
                                                                                  
                                                                                   
                                                        </span>`
                                        :`<strong>${value.options.size} </strong>` 
                                    }           
                                </td>

                                <td class="col-md-2">

                                    ${value.qty > 1

                                    ?`<button type="submit" class="btn btn-danger btn-sm"id="${value.rowId}" 
                                                        onclick="mycartDecrement(this.id)">-</button>`

                                    :`<button type="submit" class="btn btn-danger btn-sm" disabled >-</button>`
                                    }

                                        <input type="text" value="${value.qty}" min="1" max="100" disabled=""style="width:25px;">

                                    <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" 
                                        onclick="mycartIncrement(this.id)">+</button>
                                </td>

                                <td class="col-md-2">
                                    <strong>R$ ${value.subtotal}</strong>    
                                </td>

                                <td class="col-md-1 close-btn">
                                    <button type="submit" class="" id="${value.rowId}" 
                                        onclick="mycartRemove(this.id)">
                                            <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                        </tr>`
                    });

                    $('#mycart').html(rows);
                }
            })
        }
        cart();

        // ajax onclick function p/ remover item Meu Carrinho
        function mycartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/user/cart-remove/' + id,
                dataType: 'json',
                success: function(data) {
                    // Função exclui o produto sem ter que 'carregar' a página novamente
                    cart();
                    // Função exclui o produto e atualiza o minicart sem ter que 'carregar' a página novamente
                    miniCart();

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                }
            });
        }

        // ajax onclick function p/ incrementar item meu carrinho
        function mycartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();

                }
            });

        }

        function mycartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                }
            });
        }
    </script>


</body>

</html>
