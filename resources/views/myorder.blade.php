@include('header')
<div class="container">
    <div class="row">
        <h1>My Orders</h1>
    </div>

 <div class="container">
    <div class="row">
        <h1>My Orders</h1>
    </div>

    @if ($order && $order->Orderitem->count() > 0)
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Address</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0; 
                        $gstRate = 18; 
                        $deliveryCharge = 50;

                        foreach ($order->Orderitem as $item) {
                            $itemTotalPrice = $item->product->discount_price * $item->quantity;
                            $subtotal += $itemTotalPrice;
                        }

                        $gstAmount = ($subtotal * $gstRate) / 100; 

                        if ($subtotal > 500) {
                            $deliveryCharge = 0; // If subtotal is greater than 500, set delivery charge to 0 (free)
                        }
                    @endphp

                    @foreach ($order->Orderitem as $item)
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>₹{{ number_format($item->product->discount_price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>₹{{ number_format($item->product->discount_price * $item->quantity, 2) }}</td> {{-- Display current item total price --}}
                            <td>{{ $item->address }}</td>

                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="5" align="right">Subtotal:</td>
                        <td>₹{{ number_format($subtotal, 2) }}</td> {{-- Display subtotal --}}
                    </tr>

                    <tr>
                        <td colspan="5" align="right">GST ({{ $gstRate }}%):</td>
                        <td>₹{{ number_format($gstAmount, 2) }}</td> {{-- Display GST amount --}}
                    </tr>

                    <tr>
                        <td colspan="5" align="right">Delivery Charge:</td>
                        <td>₹{{ number_format($deliveryCharge, 2) }}</td> {{-- Display delivery charge --}}
                    </tr>

                    <tr>
                        <td colspan="5" align="right"><strong>Total Amount:</strong></td>
                        <td><strong>₹{{ number_format($subtotal + $gstAmount + $deliveryCharge, 2) }}</strong></td> {{-- Display total amount --}}
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <p>No orders found.</p>
        </div>
    </div>
@endif

                                    
{{-- =========================================================== --}}


    
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