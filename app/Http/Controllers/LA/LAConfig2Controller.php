<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dwij\Laraadmin\Models\LAConfigs;

class LAConfig2Controller extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$running_line_type = [
			'news' => 'News',
			'text' => 'Text'
		];
		$configs = LAConfigs::getAll();
		return View('la.la_configs.index_frontend', [
			'configs' => $configs,
			'running_line_type' => $running_line_type,
		]);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$all = $request->only([
			"number_news",
			"number_news_in_main_category",
			"running_line_type",
			"running_line_text_ua",
			"running_line_text_ru",
			"running_line_text_en",
			"region_position_on_homepage"
		]);
		foreach($all as $key => $value) {
			LAConfigs::where('key', $key)->update(['value' => $value]);
		}
		
		return redirect(config('laraadmin.adminRoute')."/site_configs");
	}	
}
