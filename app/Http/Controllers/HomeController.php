<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\App;
use App\Models\News_Headline;
use App\Models\Links_Headline;
use App\Models\News;
use App\Models\Radio;
use App\Models\Tv;
use App\Models\Tv_program;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    var $locale = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->locale = App::getLocale();
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $mainCategoryNews = News::where("main_thing", 1)->where(function($query){
					$query->where("expire_main_thing", ">", date("Y-m-d H:i:s"));
					$query->orWhere("expire_main_thing", "<", "2000-01-01 00:00:00");
				})->orderBy("datetime", "desc")->limit(3)->get()->toArray();
				
				$runningLineNews = News::where("running_line", 1)->where(function($query){
					$query->where("expire-running_line", ">", date("Y-m-d H:i:s"));
					$query->orWhere("expire-running_line", "<", "2000-01-01 00:00:00");
				})->orderBy("datetime", "desc")->limit(3)->get()->toArray();
        $newsHeadlines = News_Headline::getShowsOnHomepage(5);
        $regionalNews = News_Headline::getRegionals(5);
        $leftLinks = Links_Headline::getLeftLinks();
        $rightLinks = Links_Headline::getRightLinks();
        $radios = Radio::where("status",1)->orderBy("position")->get()->toArray();
        $tvs = Tv::where("status",1)->orderBy("position")->get()->toArray();
    		$tvProgram = Tv_program::getTVProgram();
        return view('home', [
        	"runningLineNews" => $runningLineNews,
          'mainCategoryNews' => $mainCategoryNews,
          'newsHeadlines' => $newsHeadlines,
          'regionalNews' => $regionalNews,
          'leftLinks' => $leftLinks,
          'rightLinks' => $rightLinks,
          'radios' => $radios,
          'tvs' => $tvs,
          'tvProgram' => $tvProgram
        ]);
    }
}