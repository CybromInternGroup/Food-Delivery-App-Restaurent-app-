
@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      {{-- <div class="col-sm-6 col-lg-3">
        <div style="position: relative; top:70px; right:-160px ; width:300px; height:260px"> --}}
            <div class="container">
                <div class="row"><div class="text-right">
                    <a href="{{url('adminchef')}}" class="btn btn-primary mt-3">Chef Index</a>
                    </div>
                    <table class="table table-hover mt-4">
                        <thead>
                          <tr>
                            <th>Sno.</th>
                            <th>Chef Name</th>
                            <th>Speciality</th>
                            <th>Image</th>
                            <th>Action</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach ($data as $data)
                           <tr>
                            <td> {{ $loop->index+1 }}</td>
                            {{-- <td><a href="products/{{$product->id}}/show">{{ $product->name }}</a></td> --}}
                            <td>{{$data->name}}</td>
                            <td>{{$data->speciality}}</td>
                            <td> <img src="chefimage/{{ $data->image }}" 
                              width="100" height="100"/>
                            </td>
                            <td>
                              <a href="{{url('/updatechef',$data->id)}}" class="btn btn-primary btn-sm">
                              Update</a> 
              
                              <a href="{{url('/deletechef',$data->id)}}" class="btn btn-danger btn-sm">
                              Delete</a> 
               
                             {{-- <form method="POST" class="d-inline" action="products/{{ $product->id }}/delete">
                              @csrf
                              @method('DELETE') --}}
                              {{-- <button type="submit" class="btn btn-danger btn-sm">Delete</button>   --}}
                             </td>
                          </tr> 
                           @endforeach 
                        </tbody>
              
                        
                      </table> 
           
                  </div> 
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
            </div>
        </div>
    </div>
   </div>
</div>   --}}
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
