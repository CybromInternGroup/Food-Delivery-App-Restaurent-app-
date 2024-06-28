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
     
        $data =food::all();
        return view('admin.foodmenu',compact('data'));
    }

    public function categories()
    {
        $data =food::all();
        return view('admin.categories',compact("data"));
        // $categories = Category::all();
        // return view('admin.categories',compact('categories'));
    }

    public function deletemenu($id){
     
        $data =food::find($id);
        $data->delete();
        return redirect()->back();

    }

    public function updateview($id){
     
        $data =food::find($id);
        return view('admin.updateview',compact("data")); 

    }

    public function update(Request $request,$id){
     
        $data =food::find($id);
        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('foodimage',$imagename);

               $data->image=$imagename;
               $data->title=$request->title;
               $data->price=$request->price;
               $data->description=$request->description;
               $data->save();

               return redirect()->back();
    

    }

    public function uploadfood(Request $request){
        $data = new food;

        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('foodimage',$imagename);

               $data->image=$imagename;
               $data->title=$request->title;
               $data->price=$request->price;
               $data->description=$request->description;
               $data->save();

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
        $data= foodchef::all();
        return view("admin.chefdata",compact("data"));
    }
    
    public function uploadchef(Request $request)
    {
        $data= new foodchef;
        $image = $request->image;

        $imagename = time().'.'.$image->getClientOriginalExtension();
           $request->image->move('chefimage',$imagename);
           $data->image=$imagename;

           $data->name = $request->name;
           $data->speciality = $request->speciality;

           $data->save();
           return redirect()->back();

    
    }

    public function viewchef()
    {
        $data=foodchef::all();
        return view("admin.viewchef",compact("data"));
    }
     
    public function adminchef()
    {
        $data=foodchef::all();
        return view("admin.adminchef",compact("data"));
    }

    public function updatechef($id)
    {
        $data=foodchef::find($id);
        return view("admin.updatechef",compact("data"));
    }

    public function deletechef($id){
     
        $data =foodchef::find($id);
        $data->delete();
        return redirect()->back();

    }
   

    public function updatefoodchef(Request $request, $id)
    {
        $data=foodchef::find($id);
        $image = $request->image;
        
        if($image)
        {
     

        $imagename = time().'.'.$image->getClientOriginalExtension();
               $request->image->move('chefimage',$imagename);
               $data->image=$imagename;
        }       

           $data->name = $request->name;
           $data->speciality = $request->speciality;

           $data->save();
           return redirect()->back();
        
        }

    public function orders()
    {
        $data=order::all();

        return view('admin.orders',compact('data'));
    }

    public function search(Request $request)
    {
        $search=$request->search;
        $data=Order::where('name','Like','%' .$search. '%')->orWhere('foodname','Like','%' .$search. '%')
        ->get();
        return view('admin.orders',compact('data'));
    }

//     public function search(Request $request)
// {
//     // Sanitize input
//     $search = $request->input('search');

//     // Perform search
//     $data = Order::where('name', 'like', '%' . $search . '%')
//                  ->orWhere('foodname', 'like', '%' . $search . '%')
//                  ->get();

//     // Pass the results to the view
//     return view('admin.orders', compact('data'));
// }

    
    // public function index(){
    //     return view('admin.index');
    // }

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
