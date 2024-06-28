
@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
    <h1>Customer Orders </h1>
     
    <form action="{{url('/search-results')}}" method="get">
        @csrf
        <input type="text" name="search" style="color:black"/>
        <input type="submit" value="search" class="btn btn-primary"/>
    </form> 

    <table class="table table-hover mt-4 datatable">
    <thead>
                  <tr>
                  <th>Sno.</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Foodname</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>

                   </tr>
                   </thead>
                   <tbody>
                        
                     @foreach ($data as $item)
                           <tr>
                            <td>{{$loop->index+1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->foodname}}</td>
                            <td>{{$item->price}}$</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price * $item->quantity}}$</td>    
                          </tr> 
                         @endforeach  
                        </tbody>
              
                        
                      </table> 
           
                  </div> 
           
          {{-- <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
            --}}
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
