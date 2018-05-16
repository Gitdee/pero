<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
function test($var = null, $exit = 1) { echo "<pre>"; print_r($var); echo "</pre>"; if($exit) { exit; } return true; }
function mb_strrev($string, $encoding = null) {
	if ($encoding === null) {
		$encoding = mb_detect_encoding($string);
	}
	$length   = mb_strlen($string, $encoding);
	$reversed = '';
	while ($length-- > 0) {
		$reversed .= mb_substr($string, $length, 1, $encoding);
	}
	return $reversed;
}
function mb_ucfirst($string, $encoding = null)
{
		if ($encoding === null) {
			$encoding = mb_detect_encoding($string);
		}
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}
function uclast($s, $encoding = null)
{
	if ($encoding === null) {
		$encoding = mb_detect_encoding($s);
	}
  $l=mb_strlen($s, $encoding)-1;
  $s[$l] = mb_strtoupper($s[$l], $encoding);
  return $s;
}

function uclwords($input){
	$input = mb_convert_case($input, MB_CASE_TITLE, 'UTF-8');
	$words = explode(" ", $input);
	foreach($words as $k => $word){
		$encoding = mb_detect_encoding($word);
		$words[$k] = mb_strrev(mb_ucfirst(mb_strrev($word, $encoding), $encoding), $encoding);
	}
	$input = implode(" ", $words);
	return $input;
}
//function uclwords($input){
//return strrev(ucwords(strrev(ucwords(strtolower($input)))));}
//}