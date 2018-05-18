<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

use Lang;
use App\Models\News;
use App\Models\Region;
use DB;

class News_Headline extends Model
{
    use SoftDeletes;
	
	protected $table = 'news_headlines';
	
	protected $hidden = [
        
  ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
  protected $appends = ['title', 'more_button', 'meta_title', 'meta_keywords', 'meta_description', 'region_title'];
  
  public function news()
  {
      return $this->hasMany(News::class, 'headline_id', 'id');
  }
  
  public function region()
  {
      return $this->belongsTo(Region::class, 'region_id', 'id');
  }	  
  
  public function getRegionTitleAttribute()
  {
      $region = $this->region()->first();
      return isset($region->name) ? $region->name : "";
  } 
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale] ;
  }
  public function getMoreButtonAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['more_button_' . $locale] ;
  }
  public function getMetaTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['meta_title_' . $locale] ;
  }
  public function getMetaKeywordsAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['meta_keywords_' . $locale] ;
  }
  public function getMetaDescriptionAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['meta_description_' . $locale] ;
  }
  
  public static function getShowsOnHomepage($newsCount = 5)
  {
    $records = static::where("show_on_homepage", 1)->where("region_headline",0)->where("status", 1)->orderBy("position")->get();
    if($records){
      $dataRecords = [];
      $k = 0;
      $locale = App::getLocale();
			$title = "title_" . $locale;
      foreach($records as $record){
        $dataRecords[$k] = $record->toArray();        
        //$dataRecords[$k]["news"] = $record->news()->select('*', DB::raw('count(*) as total'))->groupBy($title)->limit($newsCount)->orderBy("datetime", "desc")->get()->toArray();
        $dataRecords[$k]["news"] = $record->news()->select('*', DB::raw('IF(fixed_new = 1 AND expire_fixed_new <> "0000-00-00 00:00:00" AND DATE_FORMAT(expire_fixed_new, "%Y-%m-%d %H-%i-%s") >= NOW(), 1 , 0) AS fixed_new'))->groupBy($title)->limit($newsCount)->orderBy("fixed_new", "DESC")->orderBy("datetime", "desc")->get()->toArray();
        $k++;
      }
      $records = $dataRecords;
    }
    return $records;
  }
  
  public static function getRegionals($newsCount = 5)
  {
    $records = static::where("status", 1)->where("region_headline",1)->orderBy("position")->orderBy("title_ua")->get();
    if($records){
      $dataRecords = [];
      $k = 0;
      $locale = App::getLocale();
			$title = "title_" . $locale;
      foreach($records as $record){
        $dataRecords[$k] = $record->toArray();
        //$dataRecords[$k]["news"] = $record->news()->limit($newsCount)->orderBy("datetime", "desc")->get()->toArray();
        $dataRecords[$k]["news"] = $record->news()->select('*', DB::raw('IF(fixed_new = 1 AND expire_fixed_new <> "0000-00-00 00:00:00" AND DATE_FORMAT(expire_fixed_new, "%Y-%m-%d %H-%i-%s") >= NOW(), 1 , 0) AS fixed_new'))->groupBy($title)->limit($newsCount)->orderBy("fixed_new", "DESC")->orderBy("datetime", "desc")->get()->toArray();
        $k++;
      }
      $records = $dataRecords;
    }
    return $records;
  }
  
  public static function getHeadlineWithNews($slug = "", $limit = 20, $offset = 0, $keyword = "")
  {
  	$locale = App::getLocale();
		$title = "title_" . $locale;
  	if($slug == "main"){

  		$record = [
				"title" => Lang::get('main.main_category'),
				"meta_title" => Lang::get('main.main_category'),
				"slug" => "main",
				"news" => []
			];

			$record["news"] = News::where("main_thing", 1)->where(function($query){
				$query->where("expire_main_thing", ">", date("Y-m-d H:i:s"));
				$query->orWhere("expire_main_thing", "<", "2000-01-01 00:00:00");
			})->where($title, "like", "%" . $keyword . "%")->offset($offset)->limit($limit)->orderBy("datetime", "desc")->get()->toArray();

  	}else{
	    $record = static::where("status", 1)->where("slug", $slug)->first();
	    if($record){
	        $recordData = $record->toArray();
	        if($keyword){
	        	$recordData["news"] = $record->news()->select('*', DB::raw('IF(fixed_new = 1 AND expire_fixed_new <> "0000-00-00 00:00:00" AND DATE_FORMAT(expire_fixed_new, "%Y-%m-%d %H-%i-%s") >= NOW(), 1 , 0) AS fixed_new'))->where("title", "like", "%" . $keyword . "%")->offset($offset)->limit($limit)->orderBy("fixed_new", "DESC")->orderBy("datetime", "desc")->get()->toArray();
	        }else{
	        	$recordData["news"] = $record->news()->select('*', DB::raw('IF(fixed_new = 1 AND expire_fixed_new <> "0000-00-00 00:00:00" AND DATE_FORMAT(expire_fixed_new, "%Y-%m-%d %H-%i-%s") >= NOW(), 1 , 0) AS fixed_new'))->offset($offset)->limit($limit)->orderBy("fixed_new", "DESC")->orderBy("datetime", "desc")->get()->toArray();
	        }
	        $record = $recordData;
	    }
		}
    return $record;
  }
  
  public static function getAllHeadlines()
  {
    $records = static::where("region_headline", 0)->where("status", 1)->orderBy("position")->get()->toArray();
    return $records;
  }
  public static function getAllRegionalHeadlines()
  {
    $records = static::where("region_headline", 1)->where("status", 1)->orderBy("position")->orderBy("title_ua")->get()->toArray();
    return $records;
  }
}
