<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class LoginController extends Controller
{
    /**
     * method for register view page
     * @return view
     */
    public function register()
    {
        return view('register');
    }
    
    /**
     * method to store register data
     * @param Request $request
     * @return redirect
     */
    public function storeRegister(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:5|string|max:255',
            'email'                 => 'required|min:10|string|email|max:255|unique:users',
            'password'              => 'required|min:7|string|min:8|confirmed',
            'password_confirmation' => 'required|min:7'
        ]);
        
        $name     = $request->name;
        $email    = $request->email;
        $password = $request->password;

        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        return redirect('dashboard');

    }
    
    /**
     * method for view login page
     * @return view
     */
    public function viewLogin()
    {
        return view('login');
    }

    /**
     * method for login verification
     * @param Request $request
     * @return redirect
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        $email    = $request->email;
        $password = $request->password;
        
        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('dashboard');
        }
        return redirect('user/login/view/new')->with('error', trans('lang.wrong_password_or_email'));
    }

    /**
     * method for logout functionality
     * @return redirect
     */
    public function logout()
    {
        Auth::logout();
        return redirect('user/login/view/new');
    }
}
