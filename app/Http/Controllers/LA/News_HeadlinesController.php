<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\News_Headline;

class News_HeadlinesController extends Controller
{
	public $show_action = true;
	public $view_col = 'title_ua';
	public $listing_cols = ['id', 'title_ua', 'title_ru', 'title_en', 'slug', 'more_button_ua', 'more_button_ru', 'more_button_en', 'position', 'region_headline', 'status', 'meta_title_ua', 'meta_title_ru', 'meta_title_en', 'meta_keywords_ua', 'meta_keywords_ru', 'meta_keywords_en', 'meta_description_ua', 'meta_description_ru', 'meta_description_en'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('News_Headlines', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('News_Headlines', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the News_Headlines.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('News_Headlines');
		
		if(Module::hasAccess($module->id)) {
			return View('la.news_headlines.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new news_headline.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created news_headline in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("News_Headlines", "create")) {
		
			$rules = Module::validateRules("News_Headlines", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("News_Headlines", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.news_headlines.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified news_headline.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("News_Headlines", "view")) {
			
			$news_headline = News_Headline::find($id);
			if(isset($news_headline->id)) {
				$module = Module::get('News_Headlines');
				$module->row = $news_headline;
				
				return view('la.news_headlines.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('news_headline', $news_headline);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("news_headline"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified news_headline.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("News_Headlines", "edit")) {			
			$news_headline = News_Headline::find($id);
			if(isset($news_headline->id)) {	
				$module = Module::get('News_Headlines');
				
				$module->row = $news_headline;
				
				return view('la.news_headlines.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('news_headline', $news_headline);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("news_headline"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified news_headline in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("News_Headlines", "edit")) {
			
			$rules = Module::validateRules("News_Headlines", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("News_Headlines", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.news_headlines.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified news_headline from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("News_Headlines", "delete")) {
			News_Headline::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.news_headlines.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
    /**
	 * Datatable position update
	 *
	 * @return
	 */
    public function position(Request $request)
    {
        
        $data = json_decode($request->data, 1);
        if($data){
            foreach($data as $key => $item){
                $oldVal = $item["oldData"];
                $data[$key]["id"] = 0;
                if($result = DB::table('news_headlines')->whereNull('deleted_at')->where('position', $oldVal)->first()){
                    $data[$key]["id"] = $result->id;
                }
            }
            foreach($data as $key => $item){
                if($item["id"]){
                    $newVal = $item["newData"];
                    DB::table('news_headlines')->whereNull('deleted_at')->where('id', $item["id"])->update(['position' => $newVal]);
                }
            }
        }
        return;
    }
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('news_headlines')->select($this->listing_cols)->whereNull('deleted_at')->orderBy("position");
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('News_Headlines');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/news_headlines/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("News_Headlines", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/news_headlines/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("News_Headlines", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.news_headlines.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
