<?php

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
}

Route::group(['as' => $as, 'middleware' => []], function () {
  
 Route::get('/script/sync-news', 'SyncController@sync_news');
 Route::get('/script/sync-social-news', 'SyncController@sync_social_news');
});

?>