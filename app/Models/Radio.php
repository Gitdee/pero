<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

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
}
