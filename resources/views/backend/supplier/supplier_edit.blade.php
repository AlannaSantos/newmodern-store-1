@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper" style="min-height: 326px;">

        <section class="content">
            <div class="row">

                <!-- ======================== EDITAR FORNECEDOR ========================  -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar Fornecedor </h3>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('supplier.update', $suppliers->id) }}">
                                    @csrf

                                    {{-- incluir dados que não podem ser vistos ou modificados 
                                        pelos usuários quando um formulário é enviado
                                        NECESSÁRIO PARA CRUD EDITAR --}}
                                    <input type="hidden" name="id" value="{{ $suppliers->id }}">

                                    <div class="form-group">
                                        <h5>Nome <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="supplier_name" class="form-control"
                                                value="{{ $suppliers->supplier_name }}">
                                            @error('supplier_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Razão Social <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="supplier_company" class="form-control"
                                                value="{{ $suppliers->supplier_company }}">
                                            @error('supplier_company')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Telefone <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="supplier_phone" class="form-control"
                                                value="{{ $suppliers->supplier_phone }}">
                                            @error('supplier_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-success mb-5" value="Atualizar">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
