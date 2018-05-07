<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

use App\Models\Link;

class Links_Headline extends Model
{
    use SoftDeletes;
	
	protected $table = 'links_headlines';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
  protected $appends = ['title'];
  
  public function links()
  {
      return $this->hasMany(Link::class, 'headline_id', 'id');
  }
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale] ;
  }
  
  public static function getLeftLinks()
  {
    $records = static::where("placing", "Left Side")->where("status", 1)->orderBy("position")->get();
    if($records){
      $dataRecords = [];
      $k = 0;
      foreach($records as $record){
        $dataRecords[$k] = $record->toArray();
        $dataRecords[$k]["links"] = $record->links()->orderBy("position")->get()->toArray();
        $k++;
      }
      $records = $dataRecords;
    }
    return $records;
  }
  
  public static function getRightLinks()
  {
    $records = static::where("placing", "Right Side")->where("status", 1)->orderBy("position")->get();
    if($records){
      $dataRecords = [];
      $k = 0;
      foreach($records as $record){
        $dataRecords[$k] = $record->toArray();
        $dataRecords[$k]["links"] = $record->links()->orderBy("position")->get()->toArray();
        $k++;
      }
      $records = $dataRecords;
    }
    return $records;
  }
  
}
