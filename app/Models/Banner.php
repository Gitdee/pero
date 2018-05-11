<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Upload;

class Banner extends Model
{
    use SoftDeletes;
	
	protected $table = 'banners';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	
	static public function rightBanners(){
		$records = static::where("status", 1)->where("placing", "Right Side")->get();
		if($records){
			$records = $records->toArray();
		}
		return $records;
	} 
	
	public function getImageAttribute()
  {
    if($this->attributes["image"]){
       return $this->attributes["image"] = Upload::find($this->attributes["image"]);
    }else{
       return $this->attributes["image"] = null;
    }
  }
	
}
