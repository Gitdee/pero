<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Tax extends Model
{
    use SoftDeletes;
	
	protected $table = 'taxes';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	protected $appends = ['title', 'region_title'];
  
  public function region()
  {
      return $this->belongsTo(Region::class, 'region_id', 'id');
  }
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale];
  }
  public function getRegionTitleAttribute()
  {
      $region = $this->region()->first();
      return isset($region->name) ? $region->name : "";
  }
  
  static public function taxesByCities(){
		$records = static::where("status", 1)->get();
		if($records){
			$recordsAll = $records->toArray();
			$records = array();
			foreach($recordsAll as $item){
				$records[$item['region_id']]["title"] = $item['region_title'];
				$records[$item['region_id']]["items"][] = $item;
			}
			uasort($records,function($a, $b){
				strcmp($a["title"], $b["title"]);
			});
		}
		return $records;
	}
  
}
