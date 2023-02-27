<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;

use Auth;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


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
    protected $redirectTo = 'dashboard/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function authenticate(Request $request) {
    //         $username = $request->input('username');
    //         $password = $request->input('password');
    
    
    //         $user = DB::table('users')
    //         ->where(['username'=>$username, 'password'=>$password])
    //         ->first();
    //         if($user){
    //         $request->session()->put('user',$user);
    //         return redirect('dashboard');
    //         }
    //     else{
        
    //         echo "error";
        
    //         $notification = array(
    //                 'message' => 'User Does not Exists!',
    //                 'alert-type' => 'error'
    //             );
    //             return back()->with($notification);
            
    //  }
    // }
   
    public function logout(Request $request) {
     Auth::logout();
     return redirect('/login');
}

    
}
