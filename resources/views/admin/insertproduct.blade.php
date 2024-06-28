@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
    <h1>Insert Product</h1>
    <div class="container">
          
        <div class="row justify-content-center">
         <div class="col-sm-8">
             <div class="card mt-3 p-3">
            <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title"  class="form-control" value="{{old('title')}}">
                    @error('title')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror
                </div>
                <br>
                <div class="form-group d-flex">
                
                    <input type="radio" name="isVeg"  class="form-check" value="1" checked>Veg
                    <input type="radio" name="isVeg"  class="form-check ms-3" value="0">Non Veg
                    @error('isVeg')
                    <p class="text-danger small">{{$message}}</p>
                    @enderror
                </div>
                <br>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price"  class="form-control" value="{{old('price')}}">
                    @error('price')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
                </div>
                <br>

                <div class="form-group">
                    <label>Discount Price</label>
                    <input type="text" name="discount_price"  class="form-control" value="{{old('discount_price')}}">
                    @error('discount_price')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
                </div>
                <br>
    
               
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description"  class="form-control"  value="{{old('dsecription')}}">
                    @error('description')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
                </div>
                <br>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image"  class="form-control"  value="{{old('image')}}">
                    
                  
                    @error('image')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
                </div>
                <br>

                <div class="form-group">
                    <label>Category</label>

                    <select class="form-control" name="category_id">
                        <option value="">Select Category </option>
                        @foreach ($categories as $item )
                        <option value="{{$item->id}}">{{$item->cat_title}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="text-danger small">{{$message}}</p>
                    @enderror
                  
                </div>
                <br>

                <div>
                  <button type="submit"  value="Create Product" class="btn btn-primary w-100">Product Created</button>  
                    {{-- <input style="color: blueviolet" type="submit" value="Save"> --}}
                </div>
            </form>
             </div>
         </div>
        </div>
      </div>
  
     </div> 
    
</div>
</div>
           
@endsection
