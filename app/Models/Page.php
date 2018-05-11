<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Page extends Model
{
    use SoftDeletes;
	
	protected $table = 'pages';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	
	protected $appends = ['title', 'description', 'meta_title', 'meta_description'];
  
  public function getTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['title_' . $locale] ;
  }
  public function getDescriptionAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['description_' . $locale] ;
  }
  public function getMetaTitleAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['meta_title_' . $locale] ;
  }
  public function getMetaDescriptionAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['meta_description_' . $locale] ;
  }
}
