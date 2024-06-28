@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
      {{-- <div class="col-sm-6 col-lg-3">
        <div style="position: relative; top:70px; right:-160px ; width:300px; height:260px"> --}}
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="text-right">
                            <a href="{{ url('/categories') }}" class="btn btn-primary mt-3">Category Menu</a>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <div class="card mt-3 p-3">
                                <form action="{{ url('/uploadfood') }}" method="post" enctype="multipart/form-data">
                      @csrf                 
                 <div class="form-group">
                    <label for="categoryId">Category</label>
                    <select name="categoryId" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    
                </div>


             <div class="form-group">
                  <label for="title">Title</label>
                     <input type="text" name="title" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" class="form-control" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          </div>

        </div>
@endsection