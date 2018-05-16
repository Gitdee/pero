<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Region extends Model
{
    use SoftDeletes;
	
	protected $table = 'regions';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	
	protected $appends = ['name'];
	
	public function getNameAttribute()
  {
      $locale = App::getLocale();
      return $this->attributes['name_' . $locale];
  }
}
