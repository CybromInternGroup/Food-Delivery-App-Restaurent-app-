
@extends('admin.index')
@section('admin')

<div class="col-3">
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.managecategory') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="cat_title">Title</label>
                    <input type="text" name="cat_title" value="{{ old('cat_title') }}" class="form-control" id="cat_title">
                    @error('cat_title')
                    <p class="small text-danger">{{ $message }}</p>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-primary">Create Category</button>
            </form>  
        </div>
    </div>
</div>

<div class="container-lg">
    <div class="row mt-4">
        <div class="col-12">
    <h1>Manage Categories ({{count($categories)}})</h1>
     
    <table class="table table-bordered datatable">
    <thead>
                  <tr>
                  {{-- <th>Sno.</th>  --}}
                  <th>Id</th>
                  <th>Name</th>
                  <th>Action</th>
                   </tr>
    </thead>
        </div>
        
                   <tbody>
                        
                     @foreach ($categories as $item)
                           <tr>
                         
                            <td>{{$item->id}}</td>
                            <td>{{$item->cat_title}}</td>
                           
                            <td>
                                <div class="d-flex gap-2">
                                <form action="{{route('admin.category.delete')}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="submit" class="btn btn-danger" value="X">
                                </form>
                                <a href="#rock{{$loop->index}}" class="btn btn-success" data-bs-toggle="modal">Edit</a>
                                {{-- {{..modal...}} --}}
                                <div class="modal fade" id="rock{{$loop->index}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">Edit {{$item->cat_title}} Category</div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                    
                                                        <form action="{{ route('admin.category.update', $item->id) }}" method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="cat_title">Title</label>
                                                                <input type="text" name="cat_title" value="{{ $item->cat_title }}" class="form-control">
                                                                @error('cat_title')
                                                                <p class="small text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div>
                                                                <input type="submit" value="Create Category" class="btn btn-primary">
                                                            </div>
                                                        </form>  
                                                    </div>
                                                </div>
                                     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                            </td>   

                          </tr> 
                         @endforeach  
                        </tbody>  
                    </table>
                  </div> 
    
</div>
</div>

           
@endsection
