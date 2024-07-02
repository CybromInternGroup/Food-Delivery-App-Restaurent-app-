
@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row mt-4">
        <div class="col-12">
            <h1 class="display-6 float-start">Manage Carts ({{count($totalCarts)}})</h1>
        </div>
          <div class="container">
         <div class="row">
          <div class="col-12">
            @foreach ($carts as $item)
            <div class="card mt-4">
              <div class="card-header">
                 <table class="table table-sm">
                  <tr>
                    <th>Order Id </th>
                    <td>{{$item->id}} </td>
                    <th>Order by </th>
                    <td>{{ ($item->users)->name }}</td>
                    <th>contact info</th>
                    <td>{{ optional($item->users)->email }}</td>

                  </tr> 
                 </table>
              </div>
              <div class="card-body">
                <table class="table">
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Product Image</th>
                  </tr>
                  @foreach ($item->orderitem as $i)
                    <tr>
                      <td>{{$i->id}}</td>
                      <td>{{$i->product->title}}</td>
                      <td>{{$i->quantity}}</td>
                      <td>
                        <img src="{{asset('storage/'. $i->product->image)}}" width="50px" alt="">
                      </td>
                    </tr> 
                  @endforeach
                </table>
            </div>
            @endforeach
            {{$carts->links() }}
          </div>
    
         </div> 
    
</div>
</div>
     

@endsection
