<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        $data['products']=Product::paginate(5);
        return view('admin.manageproduct',$data);
    }

    public function insert(){
        $data['categories']=Category::all();
        return view('admin.insertproduct',$data);
    }

    public function edit(){
        return view('admin.editproduct');
    }
    
   
    public function store(Request $request){
        $data = $request->validate([
            'title'=>'required',
            'isVeg'=>'required',
            'price'=>'required',
            'discount_price'=>'required',
            'description'=>'required',
            'image'=>'required',
            'category_id'=>'required',
        ]);

        $filename = $request->file('image')->getClientOriginalName();
        // dd($filename);
        $path = $request->file('image')->storeAs('public',$filename);

         $data['image'] = $filename;
        // dd($data);

       Product::create($data);
       return redirect()->route('admin.product')->with('msg','Product Inserted Successfully');

    }


    public function removeproduct(Request $request){
        
    }

}
