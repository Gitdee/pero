<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Tv_program extends Model
{
    use SoftDeletes;
	
	protected $table = 'tv_programs';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	
	protected $appends = ['title'];
	
	public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale];
  }
  
  public static function getTVProgram()
  {
    $records = static::where("datetime", "<>", "")->where("datetime", ">", date("Y-m-d H:i:s"))->where("status", 1)->orderBy("datetime")->get();
    if($records){
      $dataRecords = [];
      foreach($records as $record){
      	$dateKey = date("Y-m-d", strtotime($record->datetime));
        $dataRecords[$dateKey]["title"] = date("l", strtotime($record->datetime));
        $dataRecords[$dateKey]["date"] = date("d.m.Y", strtotime($record->datetime));
        $dataRecords[$dateKey]["items"][] = $record->toArray();
      }
      $records = $dataRecords;
    }
    return $records;
  }
	
	
}
