@extends('layout')

@section('title')
    New Expense
@endsection

@section('head')
    <style>
        label{
            margin:5px 50px 0 0; float:right;
            font-size: 20px;
        }
    </style>
    
    <script>
        $(document).ready(function(){
            var rowCount = 1;
            $("#add").click(function(){
                rowCount++;
            $('#ProductTable > tbody:last-child').append(
                '<tr onchange="calcSum('+ rowCount + ')">' +
                '<td>' + 
                    '<select name="title[]" class="form-control" id="product_' + rowCount +'" onchange="fillBlank('+ rowCount +')">'+
                        '<option disabled selected hidden value="">Select Product...</option>' +
                        @foreach ($products as $product)
                            '<option value="{{ $product->id }}">{{ $product->title }}</option>' +
                        @endforeach
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<input type="textbox" class="form-control"  name="amount[]" id="amount_' + rowCount + '">' +
                '</td>' +
                '<td>' +
                    '<input type="textbox" class="form-control" name="price[]" id="price_' + rowCount + '">' +
                '</td>' +
                '<td>' +
                    '<input type="textbox" class="form-control" name="tax[]" id="tax_' + rowCount + '">' +
                '</td>' +
                '<td>' +
                    '<input type="textbox" class="form-control" id="sum_' + rowCount +'">' +
                '</td>' +
                '</tr>'
                );
            });
        });
    
        function fillBlank(row) {
            var productId = $('#product_' + row).val();
            $.ajax({
            data: {id:productId},
            url: '/getExpenseProducts',
            type: 'POST',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                var amount = $('#amount_' + row);
                var price = $('#price_' + row);
                var tax = $('#tax_' + row);
                var sum = $('#sum_' + row);
                amount.val(1);
                price.val(response['sell_price']);
                tax.val(response['tax']);
                var sumValue = price.val() * amount.val() * tax.val() / 100 + price.val() * amount.val();
                sum.val(sumValue); 
            }
        });   
      }
    
      function calcSum(row) {
            var amount = $('#amount_' + row);
            var price = $('#price_' + row);
            var tax = $('#tax_' + row);
            var sum = $('#sum_' + row);
            var sumValue = price.val() * amount.val() * tax.val() / 100 + price.val() * amount.val();
            sum.val(sumValue); 
      }
    
    </script>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            New Expense
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="/expenses" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Description</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="desc" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Supplier</label>
                    </div>
                    {{-- <div class="col-md-5">
                        <select style="width: 400px; float: left;" name="supplier" onchange="this.nextElementSibling.value=this.options[this.selectedIndex].text" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        <input name="supplier" autocomplete="off" style="width: 380px; margin-left: -399px; margin-top: 1px; height: 31px; border: none; float: left;" class="form-control"/> 
                    </div> --}}
                    <div class="col-md-5">
                        <select name="supplier" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Expense Date</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="expense_date" class="form-control" value="{{ Carbon\Carbon::now() }}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="">Status</label>
                    </div>
                    <div class="col-md-5">
                        <span onclick="document.getElementById('paid').checked = true"><input type="radio" name="status" value="paid" id="paid" checked="">Paid</span>
                        <span onclick="document.getElementById('notpaid').checked = true" style="margin-left: 30px;"><input type="radio" id="notpaid" name="status" value="not paid">Not Paid</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="">Payment Date</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="payment_date" class="form-control" value="{{ Carbon\Carbon::now() }}">
                    </div>
                </div>
                 <hr>

                <table class="table" id="ProductTable">
                    <thead>
                        <tr>
                            <th>Product / Service</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Sum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onchange="calcSum(1)">
                            <td>
                                <select name="title[]" class="form-control" id="product_1" onchange="fillBlank(1)">
                                    <option disabled selected hidden value="">Select Product...</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type='textbox' class="form-control"  name="amount[]" id="amount_1">
                            </td>
                            <td>
                                <input type='textbox' class="form-control" name="price[]" id="price_1">
                            </td>
                            <td>
                                <input type='textbox' class="form-control" name="tax[]" id="tax_1">
                            </td>
                            <td>
                                <input type='textbox' class="form-control" id="sum_1">
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                

                <input type='button' value='Add Product' class="btn" id='add'>
                

                <div class="form-group row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-5">
                             <button type="submit" class="btn btn-success">Save</button>
                        </div>
                </div>
                
                 </form>

                 @include('partials.errors')
        </div>
    </div>

@endsection

