<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use DB;

use App\Models\Page;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request, $url_title = "")
    {
      $page = $url_title ? Page::where('slug', "like", $url_title)->where('status', "1")->whereNull('deleted_at')->first() : null;
      if($page){
      	$page = $page->toArray();
      }
      test($page);
      if($page){
        $view = "frontend.page.index";
        return view($view, [
          'page' => $page,
			  ]);         
      }else{
        abort(404); 
        return view('errors.404', [
			  ]); 
      }      
    }
    
    public function set_region(Request $request){
    	$regionalID = $request->region_id;
    	$cookie = null;
    	if($regionalID){
    		$cookie = Cookie::make('region_id', $regionalID, 360);	
    	}
    	//test(Cookie::get('region_id'));
    	return response()->json([
        'status' => "success"
      ])->withCookie($cookie);
    }
}