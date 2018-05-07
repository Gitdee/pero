<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $newsCount = DB::table("news")->whereNull('deleted_at')->count();
        $newsHeadlinesCount = DB::table("news_headlines")->whereNull('deleted_at')->count();
        $newsResourcesRssesCount = DB::table("news_resources_rsses")->whereNull('deleted_at')->count();
        $linksCount = DB::table("links")->whereNull('deleted_at')->count();
        $bannersCount = DB::table("banners")->whereNull('deleted_at')->count();
        $linksHeadlinesCount = DB::table("links_headlines")->whereNull('deleted_at')->count();
        return view('la.dashboard',[
          'newsCount' => $newsCount,
          'newsHeadlinesCount' => $newsHeadlinesCount,
          'newsResourcesRssesCount' => $newsResourcesRssesCount,
          'linksCount' => $linksCount,
          'linksHeadlinesCount' => $linksHeadlinesCount,
          'bannersCount' => $bannersCount
        ]);
        return view('la.dashboard');
    }
}