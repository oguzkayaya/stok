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
                    <div class="col-md-12">
                        <table width="100%" class="table table-striped table-bordered table-hover ">
                            <thead>
                                <tr role="row">
                                    <th>Title</th>
                                    <th>Sell Price</th>
                                    <th>Buy Price</th>
                                    <th>Tax</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <form action="/products/{{ $product->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->sell_price }}</td>
                                        <td>{{ $product->buy_price }}</td>
                                        <td>
                                            <div class="col-md-7">
                                                {{ $product->tax }}
                                            </div>
                                            <div class="col-md-5">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                                <form action="/products" method="post">
                                    @csrf
                                    <tr>
                                        <td>
                                            <input type="text" name="title" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="sell" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="buy" class="form-control">
                                        </td>
                                        <td>
                                            <div class="col-md-7">
                                                <select name="tax" class="form-control">
                                                    <option value="18">%18</option>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
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
@endsection