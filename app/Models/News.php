<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

use App\Models\News_Resources_RSS;

class News extends Model
{
    use SoftDeletes;
	
	protected $table = 'news';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	
	//protected static $constraints = ['status' => 1, 'approved' => 1];
	
	protected $appends = ['title', 'resource_title'];  
  public function resource()
  {
      return $this->belongsTo(News_Resources_RSS::class, 'resource_id', 'id');
  }
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale] ? $this->attributes['title_' . $locale] : $this->attributes['title_ua'];
  }
  
  public function getResourceTitleAttribute()
  {
      $resource = $this->resource()->first();
      return isset($resource->title) ? $resource->title : "";
  } 
}
