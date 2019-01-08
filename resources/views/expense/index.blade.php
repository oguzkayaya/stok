@extends('layout')

@section('title')
    Expenses
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="col-md-10">Expenses</div>
                <a href="/expenses/create" class="btn btn-success">New Expense</a>
            </h1>
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
                                                <th>Creation date</th>
                                                <th>Description</th>
                                                <th>Total price</th>
                                                <th>Status</td>
                                                <th>Payment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr onclick="window.location='/expenses/{{ $expense->id }}'">
                                                    <td>{{ $expense->created_at }}</td>
                                                    <td>{{ $expense->description }}</td>
                                                    <td>{{ $expense->expense_price }}</td>
                                                    <td>{{ $expense->status }}</td>
                                                    <td
                                                         @if($expense->payment_date < Carbon\Carbon::now() && $expense->status == 'not paid')
                                                            {{ 'style=color:red;' }}  
                                                         @else
                                                            {{ 'style=color:green;' }} 
                                                         @endif>{{ $expense->payment_date }}</td>
                                                </tr>
                                            @endforeach
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