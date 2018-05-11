<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	Route::resource(config('laraadmin.adminRoute') . '/footer_menus', 'LA\Footer_MenusController');
	Route::post(config('laraadmin.adminRoute') . '/footer_menus/update_hierarchy', 'LA\Footer_MenusController@update_hierarchy');
	
	Route::resource(config('laraadmin.adminRoute') . '/top_menus', 'LA\Top_MenusController');
	Route::post(config('laraadmin.adminRoute') . '/top_menus/update_hierarchy', 'LA\Top_MenusController@update_hierarchy');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	
	

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== News_Headlines ================== */
	Route::resource(config('laraadmin.adminRoute') . '/news_headlines', 'LA\News_HeadlinesController');
	Route::get(config('laraadmin.adminRoute') . '/news_headline_dt_ajax', 'LA\News_HeadlinesController@dtajax');
    Route::post(config('laraadmin.adminRoute') . '/news_headline_position', 'LA\News_HeadlinesController@position');

	/* ================== News_Resources_RSSes ================== */
	Route::resource(config('laraadmin.adminRoute') . '/news_resources_rsses', 'LA\News_Resources_RSSesController');
	Route::get(config('laraadmin.adminRoute') . '/news_resources_rss_dt_ajax', 'LA\News_Resources_RSSesController@dtajax');

	/* ================== News ================== */
	Route::resource(config('laraadmin.adminRoute') . '/news', 'LA\NewsController');
	Route::get(config('laraadmin.adminRoute') . '/news_dt_ajax', 'LA\NewsController@dtajax');

	/* ================== Links_Headlines ================== */
	Route::resource(config('laraadmin.adminRoute') . '/links_headlines', 'LA\Links_HeadlinesController');
	Route::get(config('laraadmin.adminRoute') . '/links_headline_dt_ajax', 'LA\Links_HeadlinesController@dtajax');
    Route::post(config('laraadmin.adminRoute') . '/links_headline_position', 'LA\Links_HeadlinesController@position');

	/* ================== Links ================== */
	Route::resource(config('laraadmin.adminRoute') . '/links', 'LA\LinksController');
	Route::get(config('laraadmin.adminRoute') . '/link_dt_ajax', 'LA\LinksController@dtajax');
    Route::post(config('laraadmin.adminRoute') . '/link_position', 'LA\LinksController@position');

	/* ================== Banners ================== */
	Route::resource(config('laraadmin.adminRoute') . '/banners', 'LA\BannersController');
	Route::get(config('laraadmin.adminRoute') . '/banner_dt_ajax', 'LA\BannersController@dtajax');

	/* ================== Radios ================== */
	Route::resource(config('laraadmin.adminRoute') . '/radios', 'LA\RadiosController');
	Route::get(config('laraadmin.adminRoute') . '/radio_dt_ajax', 'LA\RadiosController@dtajax');

	/* ================== Tvs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/tvs', 'LA\TvsController');
	Route::get(config('laraadmin.adminRoute') . '/tv_dt_ajax', 'LA\TvsController@dtajax');

	/* ================== Tv_programs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/tv_programs', 'LA\Tv_programsController');
	Route::get(config('laraadmin.adminRoute') . '/tv_program_dt_ajax', 'LA\Tv_programsController@dtajax');

	/* ================== Pages ================== */
	Route::resource(config('laraadmin.adminRoute') . '/pages', 'LA\PagesController');
	Route::get(config('laraadmin.adminRoute') . '/page_dt_ajax', 'LA\PagesController@dtajax');
});
