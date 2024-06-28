@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="container-scroller">
            <div style="position:relative; top:60px; right:-150px">
            <table bgcolor="grey" border="3px">
                <tr>
                    <th style="padding:30px">Name</th>
                    <th style="padding:30px">Email</th>
                    <th style="padding:30px">Action</th>
                </tr>
                @foreach ($data as $data)
                <tr align="center">
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
    
                    @if($data->is_admin=="0")
                        
                    <td><button><a href="{{url('/deleteuser',$data->id)}}">Delete</a></td></button>
                    @else
                    <td><button><a href="">Not Allowed</a></td></button>
                    @endif
    
                </tr>
                @endforeach
    
            </table>
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