
@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      <div class="container">
        <div class="row"><div class="text-right">
            <a href="{{url('adminchef')}}" class="btn btn-primary mt-3">Chef Index</a>
         
            </div>
            <div class="row justify-content-center">
              <div class="col-sm-8">
                  <div class="card mt-3 p-3">
                 <form action="{{url('/updatefoodchef',$data->id)}}" method="post" enctype="multipart/form-data">
                      @csrf
                     <div class="form-group">
                         <label>Chef Name</label>
                         <input type="text" name="name"  class="form-control" value="{{$data->name}}" required/>
                     </div>
                     <br>
         
                     <div class="form-group">
                         <label>Speciality</label>
                         <input type="text" name="speciality"  class="form-control" value="{{$data->speciality}}" required/>
                     </div>
                     <br>
        
     
                     <div class="form-group">
                         <label>old Image</label>
                         <img height="50" width="50" src="/chefimage/{{$data->image}}" />
                     </div>
                     <br>
     
                     <div class="form-group">
                         <label>New Image</label>
                         <input type="file" name="image" required/>
                     </div>
                     <br>
     
                     <div>
                       <button type="submit" class="btn btn-primary" value="update chef">Update Chef</button>    
                         {{-- <input style="color: blueviolet" type="submit" value="Save"> --}}
                     </div>
                 </form>
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
