<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    // public function login(Request $request){
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if(Auth::guard('admin') && Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
    //         return redirect()->intended(route('dashboard'));
    //     } else{
    //         return back()->with('status', "Email and Password doesn't Match! Please Provide a Correct info!");
    //     }
    // }

    public function login(Request $request){
        //Validation
        $this->validate($request, [
            'email'         => 'email|required',
            'password'      => 'required|min:6'
        ]);

        //Attempt to log the employee in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            //If successful then redirect to the intended location
            return redirect()->intended(route('dashboard'));
        }

        //If unsuccessfull, then redirect to the admin login with the data
        Session::flash('login_error', "Username and password combination doesn't match. Please provide correct email and password");
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Admin Logout Successfully!');
    }
}
