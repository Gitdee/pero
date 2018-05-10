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
use App\Models\News;
/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
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
    public function index(Request $request, $slug)
    {
        $newsHeadlines = News_Headline::getAllHeadlines();
        $regionalHeadlines = News_Headline::getAllRegionalHeadlines();
        
        $page = $request->has("page") ? $request->page : 1;
        $keyword = $request->has("keyword") ? $request->keyword : "";
        $limit = 20;
        $offset = $limit*($page - 1);
        
        $headlineWithNews = News_Headline::getHeadlineWithNews($slug, $limit, $offset, $keyword);
        /*
        if($request->ajax()){
            return "AJAX";
            $contents = view('frontend.news.list', [
		          'headlineWithNews' => $headlineWithNews,
		        ])->render();
		        test($contents);
        }
        */
        return view('frontend.news.index', [
          'newsHeadlines' => $newsHeadlines,
          'regionalHeadlines' => $regionalHeadlines,
          'headlineWithNews' => $headlineWithNews,
        ]);
    }
}