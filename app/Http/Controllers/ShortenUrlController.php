<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\UrlDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShortenUrlController extends Controller
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
     * method for url index page
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $loggedInUser = Auth::user();
        $data         = UrlDetail::when($loggedInUser->role == 'client', function($query) use($loggedInUser) {
            $query->where('user_id', $loggedInUser->id);
        })
        ->get(['id', 'url', 'short_url', 'is_active'])->transform(function($item) {
            $item->tiny_url = url('url' . DIRECTORY_SEPARATOR . $item->short_url);

            return $item;
        });
        
        return view('url-shortener.index',compact('data'));
    }

    /**
     * method to create or update url entry
     * @param Request $request
     * @return redirect
     */
    public function createOrUpdateUrl(Request $request)
    {
        $data = $request->except('_token');
        if (!$request->id) {
            $data['short_url'] = uniqid();
            $data['user_id']   = Auth::user()->id;
            $request->validate([
                'url'       => 'required|url',
                'is_active' => 'required|in:active,deactive'
            ]);
        }

        UrlDetail::updateOrCreate(['id' => $request->id], $data);

        return redirect('short-urls')->with('insert', trans('lang.url_data_saved_successfully'));
    }

    /**
     * method to delete url
     * @param UrlDetail $urlId
     * @return response
     */
    public function delete(UrlDetail $urlId)
    {
        $urlId->delete();

        return response()->json(['message' => trans('lang.url_data_deleted_successfully')]);
    }

    /**
     * method for url create page
     * @return view
     */
    public function create()
    {
        
        return view('url-shortener.create');
    }

    /**
     * method for redirect url based on short url, it can redirect only active url
     * @param string $shortUrl
     * @return redirect
     */
    public function redirectUrl(String $shortUrl)
    {
        $urlData = UrlDetail::where([['is_active', 'active'], ['short_url', $shortUrl]])->first();
        if ($urlData) {
            return redirect($urlData->url);
        } else {
            return redirect('page-not-found');
        }
    }
}
