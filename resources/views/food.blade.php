<!-- ***** Menu Area Starts ***** -->
<section class="section" id="menu">
 <center><h2>Our Menu</h2></center>
    <div class="container">
        @foreach ($categories as $cat)
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-capitalize h4 text-secondary">{{$cat->cat_title}}</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($cat->products as $item)
                <div class="col-3">
                    <div class="card mb-3">
                        <img src="{{asset("storage/".$item->image)}}" alt="" class="card-img-top"
                            style="height:200px;object-fit:cover">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->title}}</h5>
                            <p class="card-text">
                                <span class="text-success fw-bold">Rs.{{$item->discount_price}}/-</span>
                                <del class="small text-muted">Rs.{{$item->price}}/-</del>
                            </p>
                        <a href="{{ route('addtoCart', ['pid' => $item->id]) }}" class="btn btn-success rounded-0 small btn-sm float-end">Add to cart</a>

                            <span class="float-end">
                            @if($item->isVeg)
                            <img src="{{asset('icons/veg.png')}}" width="30px" height="30px" alt="">
                            @else
                            <img src="{{asset('icons/non veg.png')}}" width="30px" height="30px" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                 @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


