<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public"

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Klassy Cafe - Restaurant HTML Template</title>
<!--
    
TemplateMo 558 Klassy Cafe

https://templatemo.com/tm-558-klassy-cafe

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="assets/images/klassy-logo.png" align="klassy cafe html template">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                           	
                        <!-- 
                            <li class="submenu">
                                <a href="javascript:;">Drop Down</a>
                                <ul>
                                    <li><a href="#">Drop Down Page 1</a></li>
                                    <li><a href="#">Drop Down Page 2</a></li>
                                    <li><a href="#">Drop Down Page 3</a></li>
                                </ul>
                            </li>
                        -->
                            <li class="scroll-to-section"><a href="#menu">Menu</a></li>
                            <li class="scroll-to-section"><a href="#chefs">Chefs</a></li> 
                            <li class="submenu">
                                <a href="javascript:;">Features</a>
                                <ul>
                                    <li><a href="#">Features Page 1</a></li>
                                    <li><a href="#">Features Page 2</a></li>
                                    <li><a href="#">Features Page 3</a></li>
                                    <li><a href="#">Features Page 4</a></li>
                                </ul>
                            </li>
                            <!-- <li class=""><a rel="sponsored" href="https://templatemo.com" target="_blank">External URL</a></li> -->
                            <li class="scroll-to-section"><a href="#reservation">Contact Us</a></li> 

                            <li class="scroll-to-section"  style="background-color: pink;">
                                
                                @auth
                                <a href="{{url('/showcart',Auth::user()->id)}}">
                                Cart
                                </a>

                                @endauth

                                @guest
                                Car[0]
                                @endguest
                            </a></li> 

                            <li>
                                @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                    @auth

                                        <li><a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a></li>
                                    @else
                                        <li><a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a></li>
                
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a></li>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                
                        </ul>        
                        {{-- <a class='menu-trigger'>
                            <span>Menu</span>
                        </a> --}}
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>

<div id="top">
 <div class="text-center">
    @if(!empty($data))
    <form action="" method="POST">
        @csrf
        <table align="center" style="border-collapse: collapse; width: 80%;">
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            <tbody>
                <!-- Loop through each item in the cart -->
                @foreach ($data as $item)
                <tr>
                    <td>
                        <input type="text" name="foodname[]" value="{{ $item['food']->title }}" hidden>
                        {{ $item['food']->title }}
                    </td>
                    <td>
                        <input type="text" name="price[]" value="{{ $item['food']->price }}" hidden>
                        {{ $item['food']->price }}
                    </td>
                    <td>
                        <input type="text" name="quantity[]" value="{{ $item['food']->quantity }}" hidden>
                        {{ $item['quantity'] }}
                    </td>
                    <td>
                        <!-- Form for removing items -->
                        <button type="submit" form action="{{ url('/remove', $item['cart']->id) }}" class="btn btn-danger">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    @else
    <p>Cart is empty</p>
    @endif
</div>

<div align="center" style="padding: 10px">
    <button class="btn btn-primary" type="button" id="order">Order Now</button>
</div>

<div id="appear" align="center" style="padding: 10px; display: none;">
    <form action="{{url('orderconfirm')}}" method="POST">
        @csrf
        @foreach ($data as $item)
                        <input type="text" name="foodname[]" value="{{ $item['food']->title }}" hidden>
                        <input type="text" name="price[]" value="{{ $item['food']->price }}" hidden>
                        {{-- <input type="hidden" name="quantity[]" value="{{ $item[]->quantity }}"> --}}
                        <input type="hidden" name="quantity[]" value="{{ $item['quantity'] }}">
                    @endforeach

        <div style="padding: 10px">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter Name">
        </div>

        <div style="padding: 10px">
            <label for="phone">Phone</label>
            <input type="text" name="phone" placeholder="Enter Number">
        </div>

        <div style="padding: 10px">
            <label for="address">Address</label>
            <input type="text" name="address" placeholder="Enter Address">
        </div>

        <div style="padding: 10px">
            <button class="btn btn-success" type="submit" value="Order Confirm">Order Confirm</button>
            <button id="close" type="button" class="btn btn-danger">Close</button>
        </div>
    </form>
</div>


{{-- <---js---> --}}

    <script type="text/javascript">
        $("#order").click(
            function()
            {
                $("#appear").show();
            }
        );

        $("#close").click(
            function()
            {
                $("#appear").hide();
            }
        );

    </script>
    
    {{-- <script type="text/javascript">
    $(document).ready(function() {
        console.log("Document ready!"); // Check if this message appears in the console
        $("#order").click(function() {
            console.log("Order Confirm button clicked!"); // Check if this message appears in the console
            $("#appear").show();
        });
    
        $("#close").click(function() {
            console.log("Close button clicked!"); // Check if this message appears in the console
            $("#appear").hide();
        });
    });
    </script> --}}



     <!-- jQuery -->
     <script src="assets/js/jquery-2.1.0.min.js"></script>

     <!-- Bootstrap -->
     <script src="assets/js/popper.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
 
     <!-- Plugins -->
     <script src="assets/js/owl-carousel.js"></script>
     <script src="assets/js/accordions.js"></script>
     <script src="assets/js/datepicker.js"></script>
     <script src="assets/js/scrollreveal.min.js"></script>
     <script src="assets/js/waypoints.min.js"></script>
     <script src="assets/js/jquery.counterup.min.js"></script>
     <script src="assets/js/imgfix.min.js"></script> 
     <script src="assets/js/slick.js"></script> 
     <script src="assets/js/lightbox.js"></script> 
     <script src="assets/js/isotope.js"></script> 
     
     <!-- Global Init -->
     <script src="assets/js/custom.js"></script>
     <script>
 
         $(function() {
             var selectedClass = "";
             $("p").click(function(){
             selectedClass = $(this).attr("data-rel");
             $("#portfolio").fadeTo(50, 0.1);
                 $("#portfolio div").not("."+selectedClass).fadeOut();
             setTimeout(function() {
               $("."+selectedClass).fadeIn();
               $("#portfolio").fadeTo(50, 1);
             }, 500);
                 
             });
         });
 
     </script>
   </body>
 </html>