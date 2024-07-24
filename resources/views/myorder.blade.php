@include('header')
<div class="container mt-5">
    <div class="row mt-5">
        <h1>My Orders</h1>
    </div>

    @if ($order->count() > 0) 
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
                            <th>Contact Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0; 
                            $gstRate = 18; 
                            $deliveryCharge = 50;
                        @endphp

                        @foreach ($order as $item)
                            @php
                                $itemTotalPrice = $item->product->discount_price * $item->quantity;
                                $subtotal += $itemTotalPrice;
                            @endphp
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>₹{{ number_format($item->product->discount_price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                {{-- <td>{{ $order_id }}</td> --}}
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>₹{{ number_format($itemTotalPrice, 2) }}</td> 


                                @foreach($address as $add) 
                                <td><span>{{$add->fullname}},</span>
                                <td><span>{{$add->alt_contact}}</span></td>
                                <td><span>{{$add->landmark}}</span></td>
                                <td><span>{{$add->street_name}}</span></td>
                                <td><span>{{$add->area}}</span></td>
                               <td><span>{{$add->pincode}}</span></td>
                               <td><span>{{$add->city}}</span></td>
                                <td><span>{{$add->state}}</span></td>
                                @endforeach
                            </tr>
                            <td>{{ $order_id }}</td>
                        @endforeach

                        <tr>
                            <td colspan="5" align="right">Subtotal:</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td> 
                        </tr>

                        <tr>
                            <td colspan="5" align="right">GST ({{ $gstRate }}%):</td>
                            <td>₹{{ number_format(($subtotal * $gstRate) / 100, 2) }}</td> 
                        </tr>

                        <tr>
                            <td colspan="5" align="right">Delivery Charge:</td>
                            <td>₹{{ number_format($deliveryCharge, 2) }}</td> 
                        </tr>

                        <tr>
                            <td colspan="5" align="right"><strong>Total Amount:</strong></td>
                            <td><strong>₹{{ number_format($subtotal + ($subtotal * $gstRate / 100) + $deliveryCharge, 2) }}</strong></td> 
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

</div>

<!-- Include your JavaScript libraries -->
<script src="assets/js/jquery-2.1.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
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
<script src="assets/js/custom.js"></script>

<script>
    $(function() {
        var selectedClass = "";
        $("p").click(function() {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function() {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });
</script>

