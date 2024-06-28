@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      {{-- <div class="col-sm-6 col-lg-3">
        <div style="position: relative; top:70px; right:-160px ; width:300px; height:260px"> --}}
            <div class="container">
                <div class="row"><div class="text-right">
                    <a href="{{url('categories')}}" class="btn btn-primary mt-3">Category Menu</a>
                    </div>
                <div class="row justify-content-center">
                 <div class="col-sm-8">
                     <div class="card mt-3 p-3">
            <form action="{{url('/uploadfood')}}" method="post" enctype="multipart/form-data">
                 @csrf
                 <div class="form-group"><br>
                    <label>Title</label>
                    <input type="text" name="title" class="form-control"/> 
                    {{-- value="{{ old('name')}}"/> --}}
                    {{-- @if($errors->has('name')) --}}
                        {{-- <span class="text-danger">{{ $errors ->first('name') }}</span>
                    @endif --}}
                    </div>
                {{-- <div>
                    <label>Title</label>
                    <input type="text" name="title" placeholder="write a title" required>
                </div> --}}
                
                <div class="form-group"><br>
                    <label>Price</label>
                    <input type="num" name="price" class="form-control" required/> 
                    {{-- value="{{ old('name')}}"/> --}}
                    {{-- @if($errors->has('name')) --}}
                        {{-- <span class="text-danger">{{ $errors ->first('name') }}</span>
                    @endif --}}
                    </div>
                {{-- <div>
                    <label>Price</label>
                    <input type="num" name="price" placeholder="price" required>
                </div> --}}
                
                <div class="form-group"><br>
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" required/> 
                    {{-- value="{{ old('name')}}"/> --}}
                    {{-- @if($errors->has('name')) --}}
                        {{-- <span class="text-danger">{{ $errors ->first('name') }}</span>
                    @endif --}}
                </div>
            
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required/>
                    {{-- @if($errors->has('image'))
                    <span class="text-danger">{{ $errors ->first('image') }}</span>
                    @endif --}}
                    </div> <br>  
                    
                <button type="submit" class="btn btn-primary">Submit</button>    
                {{-- <div>
                    <label>Description</label>
                    <input type="text" name="description"  placeholder="description" required>
                </div>
                <br> --}}
                
                {{-- <div>
                    <label>Image</label>
                    <input type="file" name="image" required>
                </div>
                <div>
                    <input style="color: blueviolet" type="submit" value="Save">
                </div> --}}
            </form>
            {{-- <div>
                <table bgcolor="black">
                    <tr>
                        <th style="padding: 25px">Food Name</th>
                        <th  style="padding: 25px">Price</th>
                        <th  style="padding: 25px">Description</th>
                        <th  style="padding: 25px">Image</th>
                        <th  style="padding: 25px">Action1</th>
                        <th  style="padding: 25px">Action2</th>


                    </tr>

                    @foreach ($data as $data)
                        <tr align="center">
                        <td>{{$data->title}}</td>
                        <td>{{$data->price}}</td>
                        <td>{{$data->description}}</td>
                        <td><img height="100" width="100" src="/foodimage/{{$data->image}}"></td>
                        <td><a href="{{url('/deletemenu',$data->id)}}">Delete</a></td>
                        <td><a href="{{url('/updateview',$data->id)}}">Update</a></td>

                    </tr>
                    @endforeach
                </table>
            </div> --}}
        </div>
    </div>
   </div>
</div>  
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
           
              {{-- <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div> --}}
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