@include('header')
    <div class="container"><br>
        <div class="row"><br><br><br>
            <div class="col-12">
                <h2>My Cart({{$count =count($order->Orderitem)}})</h2>
            </div>
            @if($count)
            <div class="col-8">
                
                @php
                $total_price= $total_discount_price = $net_payable = 0;
                $delivery_charge= 50;
                @endphp
                @foreach ($order->Orderitem as $item)
                 <div class="card mt-2 mb-0">
                    <div class="card-body">
                        <div class="row"> 
                {{-- Prodcts here  --}}
                     <div class="col-2">
                            <img src="{{asset('storage/' .$item->product->image)}}" class="w-100" alt="">
                        </div>
                        <div class="col-10">
                          <h2 class="h5 text-capitalize">{{$item->product->title}}</h2>
                          <div class="container">
                             <h6>₹{{$item->product->discount_price * $item->quantity}}/-<del>₹{{$item->product->price * $item->quantity}}/-</del></h6>
                          </div>
                            <div class="col-4">
                                <a href="{{route('removefromCart',$item->product->id)}}" class="btn btn-danger">-</a>
                                <span>{{$item->quantity}}</span>
                                <a href="{{route('addtoCart',$item->product->id)}}" class="btn btn-success">+</a>
                            </div>  
                          
                        </div>
                   </div>
                    </div>
                 </div>
                 @php
                     $total_price += ($item->product->price * $item->quantity);
                     $total_discount_price += ($item->product->discount_price * $item->quantity);


                 @endphp

                 {{-- @php
                 // Debugging: Output total price after the loop
                 echo "Total Price: " . $total_price;
             @endphp --}}
             
                 @endforeach
                 </div>
            <div class="col-4 ">
                <div class="list-group">
                    <span class="list-group-item list-group-item-action">Total Price
                        <span class="float-end">₹{{$total_price}}</span>
                    </span>
                    <span class="list-group-item list-group-item-action bg-success text-white">Discount:
                        <span class="float-end">₹{{$total_price - $total_discount_price}}</span>
                    </span>
                    <span class="list-group-item list-group-item-action">Tax (GST 18%):
                        <span class="float-end">₹{{ $gst = $total_discount_price * 0.18}}</span>
                    </span>
                    @php
                    
                        $net_payable = $total_discount_price + $gst;
                        $delivery_charge = ($net_payable <= 500)? 50 :0;  
                    @endphp
                    <span class="list-group-item list-group-item-action">Delivery Charge:
                        <span class="float-end">
                          @if ($delivery_charge)
                           ₹{{ $delivery_charge }}
                          @else
                              Free
                          @endif
                    
                    </span>
                        </span>
                    <span class="list-group-item list-group-item-action display-6 fw-bold text-success" style="font-size: 24px !important;">Net Payable:
                        <span class="float-end">
                            ₹{{$total_payable_amount= $net_payable + $delivery_charge}}
                            @php
                                session()->put('amount',$total_payable_amount);
                            @endphp
                    </span>
                    </span>
    
                </div>
                 
                <div class="d-flex mt-5 gap-1">
                    <div class="col">
                        <a href="{{route('home.index')}}" class="btn btn-dark w-100 btn-lg">Add More</a>
                    </div>
                    <div class="col">
                        <a href="{{route('saveadd')}}" class="btn btn-success w-100 btn-lg">Proceed</a>
                    </div>
                </div>


            </div>
            @else
               
            {{-- <h1 class="display-3 text-secondary fw-bold">Cart is Empty</h1>
            <a href="{{route('home.index')}}" class="btn btn-lg btn-dark w-20 mt-3">Shop now</a> --}}
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="display-3 text-warning fw-bold ">Cart is Empty</h1>
                
            
                    <a href="{{ route('home.index') }}" class="btn btn-lg btn-dark mt-3">Shop now</a>
                </div>
            </div>
            
        @endif
              
        </div>
    </div>
    
    
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