<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class SyncController
 * @package App\Http\Controllers
 */
class SyncController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * sync_news.
     *
     * @return Response
     */
    public function sync_news()
    {
      dispatch(new \App\Jobs\NewsSyncJob);
    }
    
    /**
     * sync_news.
     *
     * @return Response
     */
    public function sync_social_news()
    {
      dispatch(new \App\Jobs\SocialNewsSyncJob);
    }
}