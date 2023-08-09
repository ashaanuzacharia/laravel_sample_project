<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest
            </ul>
  
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
      //group add limit
      var maxGroup = 50;
      //add more fields group
      $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="row mt-3 fieldGroup">'
                  +'<div class="col-12 col-sm-2 mt-3 mt-sm-0">'
                  +'<select name="item" id="item" placeholder="" class="form-control" required onchange="getPrice()"><option value="">&nbsp;&nbsp;select</option>@foreach($products as $product)<option value="{{ $product -> name }}">&nbsp;&nbsp;{{ $product -> name }}</option>@endforeach</select>&nbsp;&nbsp;&nbsp;'
                  +'</div>'
                  +'<div class="col-12 col-sm-3 mt-3 mt-sm-0">'
                  +'<input id="qty" class="form-control col-md-12 col-xs-12" name="qty[]" value="" required="required" type="number" onchange="total()">&nbsp;&nbsp;&nbsp;'
                  +'</div>'
                  +'<div class="col-12 col-sm-3 mt-3 mt-sm-0">'
                  +'<input id="price" class="form-control col-md-12 col-xs-12" name="price[]" value=""  type="text">&nbsp;&nbsp;&nbsp;'
                  +'</div>'
                  +'<div class="col-12 col-sm-2 mt-3 mt-sm-0">'
                  +'                        <input type="number" step="0.01" id="sub_total" name="sub_total" class="form-control"  value="" readonly>&nbsp;&nbsp;&nbsp;'
                  +'</div>'
                  +'<div class="col-12 col-sm-2 mt-3 mt-sm-0">' 
                  +'<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger remove">Remove</a>'
                  +'</div>'
                  +'</div>'
                  +'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
            document.getElementById("tickets").value =$('body'). find('.fieldGroup').length  
          }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
          }
      });

      //remove fields group
      $("body").on("click",".remove",function(){ 
          $(this).parents(".fieldGroup").remove();
          document.getElementById("tickets").value =$('body'). find('.fieldGroup').length  
      });
    });  

    function getPrice(){
      var item = document.getElementById("item").value;
      $.ajax({url: '/product/'+item+'/price', success: function(result){
        document.getElementById("price").value = result.price;
      }});
    }
    function getCustomer(){
      var name = document.getElementById("name").value;
      $.ajax({url: '/customer/'+name+'/discount', success: function(result){
        document.getElementById("discount").value = result.discount;
      }});
    }
    
    function total() 
    {
      var price = document.getElementById("price").value;
      var qty = document.getElementById("qty").value;
      
      var total = (price * qty )
      if (!isNaN(total)){
        console.log(total);
        document.getElementById("sub_total").value = total;
      } 
   }
    function calc() 
    {
      var price = document.getElementById("price").value;
      var qty = document.getElementById("qty").value;
      var discount = document.getElementById("discount").value;
      var total = ((price * qty ) + ((price * 0.01 * discount)))
      if (!isNaN(total)){
        console.log(total);
        document.getElementById("total").value = total;
      } 
   }
</script>

@yield('content')
 <!-- Page footer begins -->
 <footer class="navbar navbar-fixed-bottom">
            <div class="container text-center">
                &copy; {{ date('Y')}}. All rights reserved.
            </div>
        </footer>    
</body>
@stack('js')
</html>