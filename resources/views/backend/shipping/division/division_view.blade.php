@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper" style="min-height: 326px;">

        <section class="content">
            <div class="row">

                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Estado</h3>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Estado</th>
                                            {{-- <th>Ação</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($divisions as $item)
                                            <tr>
                                                <td> {{ $item->shipping_division_name }} </td>

                                                {{-- <td width="40%">
                                                    <a href="{{ route('division.edit', $item->id) }}"
                                                        class="btn btn-warning" title="Edit Data"><i
                                                            class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('division.delete', $item->id) }}"
                                                        class="btn btn-danger" title="Delete Data" id="delete">
                                                        <i class="fa fa-trash"></i></a>
                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
