@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="text-right">
          <a href="{{url('categories')}}" class="btn btn-primary mt-3">Category Menu</a>
          </div>
        <div class="row justify-content-center">
         <div class="col-sm-8">
             <div class="card mt-3 p-3">
            <form action="{{url('/update',$data->id)}}" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title"  class="form-control" value="{{$data->title}}" required/>
                </div>
                <br>
    
                <div class="form-group">
                    <label>Price</label>
                    <input type="num" name="price"  class="form-control" value="{{$data->price}}" required/>
                </div>
                <br>
    
               
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description"  class="form-control"  value="{{$data->description}}" required/>
                </div>
                <br>

                <div class="form-group">
                    <label>old Image</label>
                    <img height="50" width="50" src="/foodimage/{{$data->image}}" />
                </div>
                <br>

                <div class="form-group">
                    <label>New Image</label>
                    <input type="file" name="image"  class="form-control" required/>
                </div>
                <br>

                <div>
                  <button type="submit" class="btn btn-primary">Update</button>    
                    {{-- <input style="color: blueviolet" type="submit" value="Save"> --}}
                </div>
            </form>
             </div>
         </div>
        </div>
      </div>
  
        {{-- <div class="card mb-4 text-white bg-primary-gradient"> --}}
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
           
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>

          </div>
                  </div>
                </div>

            </div>


                  
      {{-- </div> --}}
      <!-- /.col-->
    </div>
     </div> 
     

@endsection