@extends('layout')

@section('title')
    Products and Services
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Products and Services</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        123
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        
    
                <div class="row">
                    <div class="col-sm-12">
                        <table width="100%" class="table table-striped table-bordered table-hover ">
                            <thead>
                                <tr role="row">
                                    <th style="width: 91px;">Rendering engine</th>
                                    <th style="width: 114px;">Browser</th>
                                    <th style="width: 104px;">Platform(s)</th>
                                    <th style="width: 78px;">Engine version</th>
                                    <th style="width: 55px;">CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product-></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection