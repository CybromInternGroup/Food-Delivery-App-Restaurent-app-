@extends('admin.index')
@section('admin')
<div class="container-lg">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="text-right">
        <a href="{{url('chefdata')}}" class="btn btn-primary mt-3">Chef Data</a>
        </div>
      <div class="row justify-content-center">
       <div class="col-sm-8">
           <div class="card mt-3 p-3">
          <form action="{{url('/uploadchef')}}" method="post" enctype="multipart/form-data">
               @csrf
              
               <div class="form-group"><br>
                <label>Name</label>
                <input type="text" name="name" class="form-control"/> 

  
              <div class="form-group">
                  <label>Speciality</label>
                  <input type="num" name="speciality"  class="form-control" value="" required/>
              </div>
              
              <div class="form-group">
                  <label>New Image</label>
                  <input type="file" name="image"  class="form-control" required/>
              </div>
              

              <div>
                <button type="submit"  value= "save" class="btn btn-primary">Submit</button>    
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

                  
      {{-- </div> --}}
      <!-- /.col-->
    </div>
     </div> 
     

@endsection