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