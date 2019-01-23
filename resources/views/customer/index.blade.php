@extends('layout')

@section('title')
    Customers
@endsection


@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Customers</h1>
    </div>
  </div>

  <div id="app">
    <customer-table></customer-table>
  </div>   
  <script src="/js/app.js"></script>
    

@endsection


@section('script-bottom')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
@endsection