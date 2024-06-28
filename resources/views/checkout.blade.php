@include('header')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>Checkout</h2>
            </div>
        
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Checkout</h2>

                        <div>Enter Address details</div>
                        <div class="text-danger">* Required fields</div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('saveadd')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Fullname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('fullname')}}" name="fullname">
                                        @error('fullname')
                                           <p class="text-danger small">{{$message}}</p>    
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">alt_contact <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('alt_contact')}}" name="alt_contact">
                                        @error('alt_contact')
                                           <p class="text-danger small">{{$message}}</p>    
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">landmark <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('landmark')}}" name="landmark">
                                        @error('landmark')
                                           <p class="text-danger small">{{$message}}</p>    
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label for="">street_name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('street_name')}}" name="street_name">
                                                 @error('street_name')
                                                   <p class="text-danger small">{{$message}}</p>    
                                                 @enderror
                                            </div>
                                            <div class="col">
                                                <label for="">area <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('area')}}" name="area">
                                                 @error('area')
                                                   <p class="text-danger small">{{$message}}</p>    
                                                 @enderror
                                            </div>
                                            <div class="col">
                                                <label for="">pincode <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="{{old('pincode')}}" name="pincode">
                                                 @error('pincode')
                                                   <p class="text-danger small">{{$message}}</p>    
                                                 @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label for="">city <span class="text-danger">*</span></label>
                                                <select class="form-control" value="{{old('city')}}" name="city">
                                                  <option value="">select city</option>
                                                  <option value="bhopal">bhopal</option>
                                                  <option value="indore">indore</option>
                                                  <option value="ujjain">ujjain</option>
                                                </select>
                                                @error('city')
                                                   <p class="text-danger small">{{$message}}</p>    
                                                 @enderror
                                            </div>
                                            <div class="col">
                                                <label for="">state <span class="text-danger">*</span></label>
                                                <select class="form-control" value="{{old('state')}}" name="state">
                                                  <option value="">select state</option>
                                                  <option value="madhya pradesh">madhya pradesh</option>
                                                  
                                                </select>
                                                @error('state')
                                                   <p class="text-danger small">{{$message}}</p>    
                                                 @enderror
                                            </div>
                                            <div class="col">
                                                <label for="">type</label>
                                                <br>

                                    <input type="radio" name="type" value="o">office
                                    <input type="radio" name="type" value="h" checked>home
                                 </div>
                                </div>
                                
                                <div class="mb-3">
                                    <input type="submit" value="Save Address" class="btn btn-success w-100 mt-3 btn-lg">
                                    
                            </div>  
                        </form>  
                        </div>
                </div>
            </div>
        </div>
        
    </div>
            <div class="col-4 ">
          <form action="{{url('payment')}}" method="post" id="orderForm">
                    @csrf
                    <input type="hidden" name="payment_id" id="paymentId"/>
                <input type="hidden" name="amount" value={{session('amount')}}>
                <input type="" name="amount" value={{session('amount')}}>
                <input type="hidden" name="address" value="{{session('address')}}">

                    <select name="address_id" id="" class="form-select form-select-lg">
                    <option value="">Select Saved Address</option>
           
                    @foreach ($addresses as $add)
                       
                            <option value="{{$add->id}}">{{$add->street_name}}, {{$add->landmark}},{{$add->area}} | {{$add->city}} -
                                {{$add->pincode}} ({{$add->state}})</option>
                       
                    @endforeach
                    </select>
                        {{-- <input type="hidden"  id ="paymentId" class="btn btn-warning w-100 btn-lg" value="Make Payment"/>Submit --}}
                        </div>
                        </form>
                    <button class="btn btn-primary" id="razorpayButton">submit</button>
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


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.getElementById('razorpayButton').addEventListener('click', function() {
            var options = {
                key: "{{ env('RAZORPAY_KEY') }}",
                amount: "{{ session('amount') * 100 }}",
                currency: "INR",
                name: "Intellostack.ai",
                description: "Razorpay",
                image: "{{ url(asset('img/cropped-Intellostack-Logo.png')) }}",
                prefill: {
                    name: "{{ auth::user()->name }}",
                    email: "{{ auth::user()->email }}"
                },
                theme: {
                    color: "#ff7529"
                },
                handler: function(response) {
                    // Handle success callback, e.g., redirect to success page
                    document.getElementById('paymentId').value = response.razorpay_payment_id;
                    console.log('Payment successful:', response);
                    // Submit the form after successful payment
                    document.getElementById('orderForm').submit();
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
    });
</script>
     
   </body>
 </html>