<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UrlDetail;
use App\Models\User;

class HomeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * method for dashboard view page
     * @return view
     */
    public function dashboard()
    {
    	$loggedInUser               = Auth::user();
    	$urlCount                   = UrlDetail::where('user_id', $loggedInUser->id)->count();
    	$all['ten_url_limit']       = User::where('url_limit', 10)->count();
    	$all['thousand_url_limit']  = User::where('url_limit', 1000)->count();
    	$all['unlimited_url_limit'] = User::where('url_limit', 'unlimited')->count();

        return view('home', compact('loggedInUser', 'urlCount', 'all'));
    }
}
