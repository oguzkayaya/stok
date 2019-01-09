@extends('layout')

@section('title')
    Suppliers
@endsection

@section('head')
    <script>
    function deleteSupplier(supplierId) {
        $.ajax({
        data: {id:supplierId},
        url: '/deleteSupplier',
        type: 'post',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function(response){
            if (response == 1)
                removeRow(supplierId);
            else
                alert(response);
        }
        }); 
    }
    
    function removeRow(supplierId) {
        $('#supplierRow_' + supplierId).remove();
    }
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Suppliers</h1>
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
                        <div class="col-md-12">
                            <form action="/suppliers" method="post" id="addSupplierForm">
                            @csrf
                            <table width="100%" class="table table-striped table-bordered table-hover ">
                                <thead>
                                    <tr role="row">
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Telephone</th>
                                        <th colspan="2">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($suppliers); $i++)
                                    <tr id="supplierRow_{{ $suppliers[$i]->id }}">
                                        <td>{{ $suppliers[$i]->name }}</td>
                                        <td>{{ $suppliers[$i]->email }}</td>
                                        <td>{{ $suppliers[$i]->telephone }}</td>
                                        <td>{{ $suppliers[$i]->address }}</td>
                                        <td>
                                            <button class="btn btn-danger" onclick="deleteSupplier({{ $suppliers[$i]->id }}); return false;">Delete</button>
                                        </td>
                                    </tr>
                                    @endfor
                                    <tr>
                                        <td>
                                            <input type="text" name="name" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="email" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="telephone" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="address" class="form-control">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-success">Add</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                        @include('partials.errors')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('script-bottom')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
<script src="../js/validation.js"></script>
@endsection


