<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Mail;
use Lang;
class Mails extends Model
{
  protected $from_email = '';
  protected $from_name = '';
  protected $locale = '';
  
  public function __construct(){
    $this->from_email = env('MAIL_FROM_EMAIL');
    $this->from_name = env('MAIL_FROM_NAME');
    $this->locale = Lang::getLocale();
  }
  
  public function expireResource($mailData = null){
    if(!$mailData) return;
    $template = "emails.expire_resource";
    $send = Mail::send($template, ['mailData' => $mailData], function ($m) use ($mailData) {
			$m->from($this->from_email, $this->from_name);
			$m->to($mailData["user_email"], $mailData["user_name"])->subject(Lang::get('main.expire_resource'));
		});
    return;
  }
  
	
}
