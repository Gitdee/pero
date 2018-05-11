<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Dwij\Laraadmin\Helpers\LAHelper;
use Illuminate\Support\Facades\App;

class FooterMenu extends Model
{
    protected $table = 'footer_menus';
    
    protected $guarded = [
        
    ];
    protected $appends = ['name'];
  
	  public function getNameAttribute()
	  {
	      $locale = App::getLocale();
	      return $this->attributes['name_' . $locale];
	  }
}
