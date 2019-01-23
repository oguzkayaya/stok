@extends('layout')

@section('title')
  Incomes
@endsection

@section('head')
    <style>
    .right{
    float: right;
  }
  .loader {
    border: 12px solid #f3f3f3;
    border-radius: 50%;
    border-top: 12px solid #3498db;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
@endsection


@section('content')
    <div id="app">
      
        <router-view></router-view>
    </div>   
    <script src="/js/app.js"></script>
</div>
@endsection