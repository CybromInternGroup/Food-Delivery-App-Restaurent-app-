@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div style="position: relative; top:65px; right:-155px;">
            <table bgcolor:"grey" border="1px">
                <tr>
                    <th style="padding: 25px">Name</th>
                    <th style="padding: 25px">Email</th>
                    <th style="padding: 25px">Phone</th>
                    <th style="padding: 25px">Date</th>
                    <th style="padding: 25px">Time</th>
                    <th style="padding: 25px">Message</th>
                </tr>

                @foreach ($data as  $data)   
                <tr align="center">
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->date}}</td>
                    <td>{{$data->time}}</td>
                    <td>{{$data->message}}</td>
                </tr>
                @endforeach
            </table>
                   
        </div>
         
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