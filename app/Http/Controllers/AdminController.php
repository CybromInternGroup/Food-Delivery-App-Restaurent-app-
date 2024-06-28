<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
// use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

use App\Actions\Fortify\AttemptToAuthenticate;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\LoginResponse;
use App\Models\User;
use App\Models\Food; 
use App\Models\Reservation; 
use App\Models\Foodchef;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Fooditem;
use App\Models\Category; 
use App\Models\Address; 




class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
        // dd($this->guard);
    }
    
    
    public function loginForm(){
        return view('auth.login',['guard'=> 'admin']);
    }
    
    public function user(){
        $data=user::all();
        return view('admin.users',compact('data'));
    }
    
    

    public function deleteuser($id){
        $data=user::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function foodmenu(){
     
        $fooditems =Fooditem::all();
        // return view('admin.foodmenu',compact('foodItems'));
        $categories =Category::all();
        return view('admin.foodmenu',compact('fooditems','categories'));
        
        
    }

    // public function categories()
    // {
    //     // $categories=Category::all();
    //     $categories = Category::with('foodItems')->get();

    //     // dd($categories);
    //     return view('admin.categories',compact('categories'));
    //     // $categories = Category::all();
    //     // return view('admin.categories',compact('categories'));
    // }


    public function deletemenu($id){
     
        $categories=FoodItem::find($id);
        $categories->delete();
        return redirect()->back();

    }

    public function updateview($id){
     
        $categories =FoodItem::find($id);
        return view('admin.updateview',compact("categories")); 

    }

    public function update(Request $request,$id){
     
        $categories =FoodItem::find($id);
        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('foodimage',$imagename);

               $categories->image=$imagename;
               $categories->title=$request->title;
               $categories->price=$request->price;
               $categories->description=$request->description;

               $categories->save();

               return redirect()->back();
    

    }

    public function uploadfood(Request $request){
        $categories = new FoodItem;

               $categories->title=$request->title;
               $categories->description=$request->description;
               $categories->category_id = $request->category_id;

               $categories->save();

               return redirect()->back();
    
    }

    public function reservation(Request $request){
        $data = new reservation;

               $data->name=$request->name;
               $data->email=$request->email;
               $data->phone=$request->phone;
               $data->guest=$request->guest;
               $data->date=$request->date;
               $data->time=$request->time;
               $data->message=$request->message;
               $data->save();

               return redirect()->back();
    }

    public function viewreservation()
    {
        // if(Auth::id())
        // {}
        $data=reservation::all();
        return view("admin.adminreservation",compact("data"));
        

        // else
        // {
        //     return redirect('login');
        // }
    }

    public function chefdata()
    {
        $data1= foodchef::all();
        return view("admin.chefdata",compact("data1"));
    }
    
    public function uploadchef(Request $request)
    {
        $data1= new foodchef;
        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();
           $request->image->move('chefimage',$imagename);
           $data1->image=$imagename;

           $data1->name = $request->name;
           $data1->speciality = $request->speciality;

           $data1->save();
           return redirect()->back();

    
    }

    public function viewchef()
    {
        $data1=foodchef::all();
        return view("admin.viewchef",compact("data1"));
    }
     
    public function adminchef()
    {
        $data1=foodchef::all();
        return view("admin.adminchef",compact("data1"));
    }

    public function updatechef($id)
    {
        $data1=foodchef::find($id);
        return view("admin.updatechef",compact("data1"));
    }

    public function deletechef($id){
     
        $data1 =foodchef::find($id);
        $data1->delete();
        return redirect()->back();

    }
   

    public function updatefoodchef(Request $request, $id)
    {
        $data1=foodchef::find($id);
        $image = $request->image;
        
        if($image)
        {
     

        $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('chefimage',$imagename);
               $data1->image=$imagename;
        }       

           $data1->name = $request->name;
           $data1->speciality = $request->speciality;

           $data1->save();
           return redirect()->back();
        
        }


public function orders(Request $request)
{
   
    $user_id = Auth::user()->id;
    $order = Order::with('Orderitem', 'address')->where('status', 0)->where('user_id', $user_id)->first();

    $order->address_id = $request->address_id;
    

    $order->save();

    $address = Address::all(); 

    return view('admin.orders', compact('order', 'address'));
}

    public function managecategory(Request $request){
        
        if ($request->isMethod('post')) {
        
            $data = $request->validate(['cat_title' => 'required']);
    
            
            Category::create($data);
    
        
            return redirect()->route('admin.managecategory')->with('msg', 'Category Inserted Successfully');
        }
    
    
        $data['categories'] = Category::all();
    
        
        return view('admin.managecategory', $data);
    }
    
    public function updatecategory(Request $request,$id){
        if ($request->isMethod('post')) {
            
            $data = $request->validate(['cat_title' => 'required']);
    
            
            Category::findOrfail($id)->update($data);
    
        }
    
        
        $data['categories'] = Category::all();
    
    
        return view('admin.managecategory', $data);
    }
    
    public function deletecategory(Request $request)
    {
        $id = $request->id;
        
        $record=Category::findOrfail($id);
        $record->delete();

        return redirect()->back()->with('msg','Category deleted successfully');
    }    
    
    public function managecart(){
        $data ['totalCarts'] = Order::where('status',false)->get();
        $data['carts'] = Order::where('status',false)->orderBy('id','desc')->paginate(1);
        return view('admin.managecart',$data);
    }
    public function search(Request $request)
    {
        $search=$request->search;
        $data=Order::where('name','Like','%' .$search. '%')->orWhere('foodname','Like','%' .$search. '%')
        ->get();
        return view('admin.orders',compact('data'));
    }


    
    
    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
            Features::enabled(Features::twoFactorAuthentication()) ? 
                RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return app(LogoutResponse::class);
    }
}
