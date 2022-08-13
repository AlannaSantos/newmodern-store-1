@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper" style="min-height: 326px;">
        <div class="container-full">

            <section class="content">
                <div class="row">   

                    <div class="col-8">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Fornecedores <span class="badge badge-pill badge-danger">
                                        {{ count($suppliers) }} </span></h3>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th> Nome </th>
                                                <th> Razão Social </th>
                                                <th> Telefone </th>
                                                <th> Acão </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- ===== PERCORRER A TABLE ===== -->
                                            @foreach ($suppliers as $item)
                                                <tr>

                                                    <td>{{ $item->supplier_name }}</td>
                                                    <td> {{ $item->supplier_company }} </td>
                                                    <td> {{ $item->supplier_phone }} </td>

                                                    <td>
                                                        <!-- ============== EDITAR ============== -->
                                                        <a href="{{ route('supplier.edit', $item->id) }}"
                                                            class="btn btn-warning" title="Editar Fornecedor"><i
                                                                class="fa fa-pencil"></i> </a>

                                                        <!-- ============== EXCLUIR ============== -->
                                                        <a href="{{ route('supplier.delete', $item->id) }}"
                                                            class="btn btn-danger" id="delete"
                                                            title="Deletar Fornecedor">
                                                            <i class="fa fa-trash"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  =============== ADICIONAR FORNECEDORES ================ -->
                    <div class="col-4">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Adicionar Fornecedores </h3>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">


                                    <form method="post" action="{{ route('supplier.store') }}">
                                        @csrf

                                        <!-- ===== INPUT FIELD NOME ===== -->
                                        <div class="form-group">
                                            <h5>Nome<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="supplier_name" class="form-control">

                                                <!-- ===== MENSAGEM DE ERRO ===== -->
                                                @error('supplier_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <!-- ===== INPUT FIELD RAZÃO SOCIAL ===== -->
                                        <div class="form-group">
                                            <h5>Razão Social<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="supplier_company" class="form-control">

                                                <!-- ===== MENSAGEM DE ERRO ===== -->
                                                @error('supplier_company')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                               
                                            </div>

                                        </div>

                                        <!-- ===== INPUT FIELD TELEFONE ===== -->
                                        <div class="form-group">
                                            <h5>Telefone<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="supplier_phone" class="form-control">

                                                <!-- ===== MENSAGEM DE ERRO ===== -->
                                                @error('supplier_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                        </div>


                                        <!-- ===== BOTÃO ADD VERDE ===== -->
                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                value="Adicionar Fornecedor">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
