@include('header')
<div class="container-md-6">
    @if ($orders->isNotEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="col-12">
                <h2>My Cart</h2>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th class="w-25">Quantity</th>
                        <th class="d-flex">Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_price = $total_discount_price = $net_payable = 0;
                    $delivery_charge = 50;
                    @endphp
                    
                    @foreach ($orders as $item)
                    <tr id="row_{{ $item->product->id }}">
                        <td>
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image" width="60" height="60" class="rounded-2" />
                        </td>
                        <td>{{ $item->product->title }}</td>
                        <td>
                            ₹{{ $item->product->discount_price }}
                            @if ($item->product->discount_price < $item->product->price)
                            <del>₹{{ $item->product->price }}</del>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-danger minus-btn" data-product-id="{{ $item->product->id }}">-</button>
                                <span class="quantity">{{ $item->quantity }}</span>
                                <button class="btn btn-success plus-btn" data-product-id="{{ $item->product->id }}">+</button>
                            </div>
                        </td>
                        <td>
                            ₹{{ $item->product->discount_price * $item->quantity }}
                        </td>
                        <td>
                            <a href="{{ route('removefromCart', ['pId' => $item->id]) }}" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                    @php
                    $total_price += ($item->product->price * $item->quantity);
                    $total_discount_price += ($item->product->discount_price * $item->quantity);
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-4">
                <div class="list-group">
                    <span class="list-group-item list-group-item-action">Total Price
                        <span class="float-end">₹{{ $total_price }}</span>
                    </span>
                    <span class="list-group-item list-group-item-action bg-success text-white">Discount:
                        <span class="float-end">₹{{ $total_price - $total_discount_price }}</span>
                    </span>
                    <span class="list-group-item list-group-item-action">Tax (GST 18%):
                        <span class="float-end">₹{{ $gst = $total_discount_price * 0.18 }}</span>
                    </span>
                    @php
                    $net_payable = $total_discount_price + $gst;
                    $delivery_charge = ($net_payable <= 500) ? 50 : 0;
                    $total_payable_amount = $net_payable + $delivery_charge;
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
                    <span id="total_payable" class="list-group-item list-group-item-action display-6 fw-bold text-success" style="font-size: 24px !important;">Net Payable:
                        <span class="float-end">₹{{ $total_payable_amount }}</span>
                    </span>
                </div>

                    {{-- <div class="d-flex mt-5 gap-1">
                        <div class="col">
                            <a href="{{ route('home.index') }}" class="btn btn-dark w-100 btn-lg">Add More</a>
                        </div>
                        <form action="{{ route('saveadd') }}" method="POST">
                            @csrf
                            <input type="hidden" id="netpayable" name="netpayable" value="{{ $total_payable_amount }}" />
                            <div class="col">

                                <button type="submit" class="btn btn-success w-100 btn-lg">Proceed</button>
                            </div>
                        </form> --}}
                       
                        <div class="d-flex mt-5 gap-1">
                            <div class="col">
                                <a href="{{ route('home.index') }}" class="btn btn-dark w-100 btn-lg">Add More</a>
                            </div>
                          <form action="{{ route('saveadd') }}" method="post">
                                @csrf
                                <input type="hidden" id="netpayable" name="netpayable" value="{{ $total_payable_amount }}" /> 
                                <div class="col"> 
                                    {{-- <a href="{{ route('saveadd') }}" class="btn btn-success w-100 btn-lg">Proceed</a> --}}

                                    <button type="submit" class="btn btn-success w-100 btn-lg">Proceed</button>
                                </div>
                            </form>
                           
                        </div>
    @else
    <div class="row align-items-center">
        <div class="col">
            <h1 class="display-3 text-warning fw-bold ">Cart is Empty</h1>
            <a href="{{ route('home.index') }}" class="btn btn-lg btn-dark mt-3">Shop now</a>
        </div>
    </div>
    @endif
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<div class="container-fluid w-full mb-4"></div>


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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const minusButtons = document.querySelectorAll('.minus-btn');
        const plusButtons = document.querySelectorAll('.plus-btn');
    
        minusButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const productId = button.getAttribute('data-product-id');
                const quantityElement = button.nextElementSibling;
                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    updateTotalPrice(productId);
                }
            });
        });
    
        plusButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const productId = button.getAttribute('data-product-id');
                const quantityElement = button.previousElementSibling;
                let quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
                updateTotalPrice(productId);
            });
        });
    
        function updateTotalPrice(productId) {
            const quantity = parseInt(document.querySelector(`#row_${productId} .quantity`).textContent);
            const discountPrice = parseFloat(document.querySelector(`#row_${productId} td:nth-child(3)`).textContent.trim().replace('₹', ''));
            const total = quantity * discountPrice;
            document.querySelector(`#row_${productId} td:nth-child(5)`).textContent = `₹${total.toFixed(2)}`;
            updateSubtotal();
        }
    
        // function updateSubtotal() {
        //     let subtotal = 0;
        //     document.querySelectorAll('tbody tr').forEach(row => {
        //         subtotal += parseFloat(row.querySelector('td:nth-child(5)').textContent.trim().replace('₹', ''));
        //     });
        //     const gst = subtotal * 0.18;
        //     const deliveryCharge = (subtotal <= 500) ? 50 : 0;
        //     const netPayable = subtotal + gst + deliveryCharge;
        //     document.querySelector('#total_payable span').textContent = `₹${netPayable.toFixed(2)}`;
        //     document.getElementById('netpayable').value = netPayable; // Update hidden input
        // }
        function updateSubtotal() {
    let subtotal = 0;
    document.querySelectorAll('tbody tr').forEach(row => {
        subtotal += parseFloat(row.querySelector('td:nth-child(5)').textContent.trim().replace('₹', ''));
    });
    const gst = subtotal * 0.18;
    const deliveryCharge = (subtotal <= 500) ? 50 : 0;
    const netPayable = subtotal + gst + deliveryCharge;
    document.querySelector('#total_payable span').textContent = `₹${netPayable.toFixed(2)}`;
    document.getElementById('netpayable').value = netPayable; // Update hidden input
}

    });
    </script>
    

