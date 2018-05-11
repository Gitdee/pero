<?php

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
}

Route::group(['as' => $as, 'middleware' => []], function () {
  
  Route::get('lang/{lang}', 'LanguageController@switchLang');
  Route::get('news/{slug}', 'NewsController@index');
  
  Route::get('/{any}', 'PageController@index')->where('any', '.*');
});

?>