@extends('layout')

@section('title')
    Suppliers
@endsection

@section('head')
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <script src="validation.js"></script> --}}
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
                                    @foreach ($suppliers as $supplier)
                                        <form action="/suppliers/{{ $supplier->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <tr>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->email }}</td>
                                                <td>{{ $supplier->telephone }}</td>
                                                <td>{{ $supplier->address }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        </form>
                                        @endforeach
                                        <form action="/suppliers" method="post" id="addSupplierForm">
                                            @csrf
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
                                        </form>
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
</div>
    
@endsection