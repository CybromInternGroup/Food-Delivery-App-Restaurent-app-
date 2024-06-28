
@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row mt-4">
        <div class="col-12">
          <div class="container">
            <h1 class="display-6 float-start">Manage Product ({{count($products)}})</h1>
          <a href="{{route('admin.product.insert')}}" class="btn btn-success float-end mt-2">Insert Product</a> 
          </div>
     
    <table class="table table-bordered table-hover datatable">
    <thead>
      
                  <th>Id</th>
                  <th>Title</th>
                  <th>IsVeg</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Category</th>
                  <th>Action</th>

                  </tr>
    </thead>
        </div>
                <tbody>
                  @foreach ($products as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>
                      @if($item->isVeg)
                         <img src="{{asset('icons/veg.png')}}" alt="">
                      @else
                         <img src="{{asset('icons/non veg.png')}}" alt="">
                      @endif
                    </td>
                    <td>{{$item->discount_price}} <del>{{$item->price}}</del></td>
                    <td><img src="{{ asset("storage/".$item->image) }}" width="50px" height="50px" alt=""></td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->category->cat_title}}</td>
                    <td>
                      <div class="btn-group">
                        <a href="" class="btn btn-danger">X</a>
                      </div>
                    </td>

                  </tr>
                    
                  @endforeach
         
                </tbody>  
                </table>
                {{$products->links() }}
                  </div> 
    
</div>
</div>

           
@endsection
