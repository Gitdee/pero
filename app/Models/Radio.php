<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

use App\Models\Upload;

class Radio extends Model
{
    use SoftDeletes;
	
	protected $table = 'radios';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
  protected $appends = ['title'];
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale] ;
  }
  public static $convertImage = true;
  public function getLogoAttribute()
  {
  	if(!self::$convertImage){
  		return $this->attributes["logo"] = $this->attributes["logo"];
  	}
    if($this->attributes["logo"]){
       return $this->attributes["logo"] = Upload::find($this->attributes["logo"]);
    }else{
       return $this->attributes["logo"] = null;
    }
  }
  
}
