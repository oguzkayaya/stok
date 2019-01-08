@extends('layout')

@section('title')
    Expenses
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
            @for ($i = 0; $i < count($expense->expense_product); $i++)
            calcSum({{ $i+1 }});
            @endfor
            var rowCount = {{ count($expense->expense_product) }};


            $("#add").click(function(){
                rowCount++;
            $('#ProductTable > tbody:last-child').append(
                '<tr id="productRow_'+rowCount+'" onchange="calcSum('+ rowCount + ')">' +
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
                    '<div class="col-md-8">' +
                        '<input type="textbox" class="form-control" id="sum_' + rowCount +'">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                        '<button onclick="removeRow(' + rowCount + '); return false;" class="btn btn-danger">Delete</button>' +
                    '</div>' +
                '</td>' +
                '</tr>'
                );
            });
        });


        function removeRow(row) {
            $('#productRow_' + row).remove();
        }

        function deleteProduct(index, product_id) {
            $.ajax({
            data: {id:product_id},
            url: '/deleteExpenseProducts',
            type: 'post',
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function(response){
                if (response == 1) {
                    removeRow(index);
                }
            }
        }); 
        }
    
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
            Expense - {{ $expense->description }}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="/expenses/{{ $expense->id }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Description</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="desc" class="form-control" value="{{ $expense->description }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Supplier</label>
                    </div>
                    <div class="col-md-5">
                        <select name="supplier" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if($expense->supplier_id == $supplier->id) {{ 'selected' }} @endif)>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Expense Date</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="expense_date" class="form-control" value="{{ $expense->expense_date }}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="">Status</label>
                    </div>
                    <div class="col-md-5">
                        <span onclick="document.getElementById('paid').checked = true"><input type="radio" name="status" value="paid" id="paid" @if ($expense->status->title == 'paid') {{ 'checked' }} @endif>Paid</span>
                        <span onclick="document.getElementById('notpaid').checked = true" style="margin-left: 30px;"><input type="radio" id="notpaid" name="status" value="not paid" @if ($expense->status->title == 'not paid') {{ 'checked' }} @endif>Not Paid</span>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="">Payment Date</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="payment_date" class="form-control" value="{{ $expense->payment_date }}">
                    </div>
                </div>
                 <hr>

                <table class="table" id="ProductTable" style="">
                    <thead>
                        <tr>
                            <th width="33%">Product / Service</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        @foreach ($expense->expense_product as $expense_product)
                            <tr onchange="calcSum({{ $index }})" id="productRow_{{ $index }}">
                                <td>
                                    <select name="title[]" class="form-control" id="product_{{ $index }}" onchange="fillBlank({{ $index }})">
                                        <option disabled selected hidden value="">Select Product...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @if ($product->id == $expense_product->product_id) {{ 'selected' }} @endif>{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type='textbox' class="form-control" autocomplete="off"  name="amount[]" id="amount_{{ $index }}" value="{{ $expense_product->amount }}">
                                </td>
                                <td>
                                    <input type='textbox' class="form-control" autocomplete="off" name="price[]" id="price_{{ $index }}" value="{{ $expense_product->price }}">
                                </td>
                                <td>
                                    <input type='textbox' class="form-control" autocomplete="off" name="tax[]" id="tax_{{ $index }}" value="{{ $expense_product->tax }}">
                                </td>
                                <td>
                                    <div class="col-md-8">
                                        <input type='textbox' class="form-control" autocomplete="off" id="sum_{{ $index }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button onclick="deleteProduct({{ $index }}, {{ $expense_product->id }}); return false" class="btn btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <?php $index++; ?>
                        @endforeach
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

