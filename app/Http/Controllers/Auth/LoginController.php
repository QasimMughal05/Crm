<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public Function redirectTo(){
        if(Auth::user()->usertype == 'admin'){
            return 'dashboard';
        }else{
            return 'home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function login(Request $r)
    {
        $user = User::where('email', $r->email)->first();
        if($user){
            if ($user->usertype == "admin"){
                if(\Auth::guard('admin')->attempt($r->only('email','password'))){
                    //Authentication passed...
                    return redirect()
                        ->intended(route('product.dashboard'))
                        ->with('status','You are Logged in as Admin!');
                }
            }else{
                if(\Auth::attempt($r->only('email','password'))){
                    //Authentication passed...
                    return redirect()
                        ->intended(route('home'))
                        ->with('status','You are Logged in as Admin!');
                }
            }
        } else {
            $this->loginFailed();
        }
       
    
    }

    
}
