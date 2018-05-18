<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use DB;
use App\Models\News;
use Twitter;
class SocialNewsSyncJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $headlines = collect(DB::table("news_headlines")->whereNull('deleted_at')->where('status', 1)->get(["id", "title_ua", "categories"]))->keyBy("id");
        $facebookRsses = collect(DB::table("news_resources_rsses")->whereNull('deleted_at')->where('status', 1)->where('socia_network', 1)->where("rss", "like", "%facebook%")->get(["id", "title", "rss", "headline_ids", "last_sync"]))->keyBy("id");
        $twitterRsses = collect(DB::table("news_resources_rsses")->whereNull('deleted_at')->where('status', 1)->where('socia_network', 1)->where("rss", "like", "%twitter%")->get(["id", "title", "rss", "headline_ids", "last_sync"]))->keyBy("id");
        /* facebook*/
        /*
        $rss = "https://www.facebook.com/npgroup/";
        $appID = "390347138042564";
        $appSecret = "7d1f87a90e463b70bd7646fc12307047";
        $token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=$appID&client_secret=$appSecret&grant_type=client_credentials");
        $token = $token ? json_decode($token)->access_token : "";
        $fb_page_id = "npgroup";
        //$fb_page_id = "SmashBalloon";
        $profile_photo_src = "https://graph.facebook.com/{$fb_page_id}/picture?type=square";
        $access_token = $token;
        $fields = "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
        $limit = 5;
        $json_link = "https://graph.facebook.com/{$fb_page_id}/feed?access_token={$access_token}&fields={$fields}&limit={$limit}";
        $json = @file_get_contents($json_link);
        test($json_link);
        $obj = json_decode($json, true);
        test($obj);
        $feed_item_count = count($obj['data']);
        */
        /**/
        
        /*twitter*/
        if($twitterRsses && $headlines){
          foreach($twitterRsses as $rKey => $rItem){
            $rItem->headline_ids = json_decode($rItem->headline_ids, 1);
            $rItem->headlines = array();
            $rItem->headlines_categories = array();
            $rItem->headlines_categories_all = array();
            if($rItem->headline_ids && is_array($rItem->headline_ids)){
              foreach($rItem->headline_ids as $hIDKey => $hIDItem){
                if(isset($headlines[$hIDItem])){
                  $rItem->headlines[$hIDItem] = $headlines[$hIDItem];
                  //$rItem->headlines_categories[$hIDItem] = explode(",", $headlines[$hIDItem]->categories);
                  //$rItem->headlines_categories[$hIDItem] = array_map("trim", $rItem->headlines_categories[$hIDItem]);
                  $rItem->headlines_categories[$hIDItem] = json_decode($headlines[$hIDItem]->categories, 1);
                  $rItem->headlines_categories[$hIDItem] = array_map("trim", $rItem->headlines_categories[$hIDItem]);
                  $rItem->headlines_categories_all = array_merge($rItem->headlines_categories_all, $rItem->headlines_categories[$hIDItem]);
                }
              }
              $twitterRsses[$rKey]->headlines = $rItem->headlines;
              $twitterRsses[$rKey]->headlines_categories = $rItem->headlines_categories;
              $twitterRsses[$rKey]->headlines_categories_all = $rItem->headlines_categories_all;
              $twitterRssNews = $this->getTwitterRSSFeeds($rItem->rss, $rItem);
              if($twitterRssNews){
                foreach($twitterRssNews as $newData){
                  $data = News::updateOrCreate(["guid" => $newData["guid"]], $newData);                  
                }
                DB::table("news_resources_rsses")->where("id", $rItem->id)->update(['last_sync' => date("Y-m-d H:i:s")]);
              }
            }
          }
        } 
        exit("Done");
    }
    
    
    public function getTwitterRSSFeeds($rssURL, $rssObject){
       $screenName = $this->getURLPartLast($rssURL);
       $tweets = Twitter::getUserTimeline(['tweet_mode' => 'extended','screen_name' => $screenName, 'count' => 20, 'format' => 'json']);
       $tweets = $tweets ? json_decode($tweets) : null;
       $news = array();
       $k = 0;
       if($tweets){
         foreach($tweets as $item) {
            $pubDate = (string)$item->created_at;
            if(isset($pubDate) && strtotime($pubDate) > strtotime($rssObject->last_sync)){
              $categories = (array_map(function($item){return trim($item->text);},$item->entities->hashtags));
              if(!array_intersect($rssObject->headlines_categories_all, $categories)){
                continue;
              }
              foreach($rssObject->headlines_categories as $hcKey => $hcItem){
                if(array_intersect($hcItem, $categories)){
                  $news[$k]["headline_id"] = $hcKey;
                  $news[$k]["resource_id"] = $rssObject->id;
                  $news[$k]["title_ua"] = trim($item->full_text);
                  $news[$k]["title_ru"] = trim($item->full_text);
                  $news[$k]["guid"] = trim($item->id_str);
                  $news[$k]["link"] = "https://twitter.com/" . trim($item->user->screen_name) . "/status/" . trim($item->id_str);
                  $news[$k]["datetime"] = date("Y-m-d H:i:s", strtotime($pubDate));
                  $k++;
                  break;
                }
              }
            }else{
              break;
            }
         }
         return !empty($news) ? $news : null;
       }else{
          return null;
       }
    }
    
    function getURLPart($position = 0, $url = ""){
      if(!$url){
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    		$url = trim($url_path, "/");
      }
  		$url_parts = $url ? explode("/", $url) : array();
  		$url_parts_total = count($url_parts);
  		if(is_int($position)){
  			if($position < 0) $position += $url_parts_total;
  			return 0 <= $position && $position < $url_parts_total ? $url_parts[$position] : null;
  		}else{
  			foreach($url_parts as $i => $part){
  				if($part == $position) return $i <= $url_parts_total ? $url_parts[$i + 1] : null;
  			}
  		}
  		return null;
  	}
  	
  	function getURLPartFirst($url = ""){
  		return $this->getURLPart(0, $url);
  	}
  	
  	function getURLPartLast($url = ""){
  		return $this->getURLPart(-1, $url);
  	}
    
}


/*
$twitterRsses = collect(DB::table("news_resources_rsses")->whereNull('deleted_at')->where('status', 1)->where('socia_network', 1)->where("rss", "like", "%twitter%")->get(["id", "title", "rss", "headline_ids", "last_sync"]))->keyBy("id");
test($twitterRsses);
$oauth_access_token = "1416293401-Q0l0m5VSY6y3rLohZKeLCvwy4deMeKF8h7cLEns";
$oauth_access_token_secret = "LmFIHyxJppBWBTMvNzusbzr3Mg4xKFbyYJRYlhCO3tJH7";
$consumer_key = "8kaDcqkZBaHDUSTbRRMi1DsKk";
$consumer_secret = "fRx9LspLEBcwkgioqMQEQoW7amoLIjRLwSbXs3LJTcupLi3JTn";
 
// we are going to use "user_timeline"
$twitter_timeline = "user_timeline";
 
// specify number of tweets to be shown and twitter username
// for example, we want to show 20 of Taylor Swift's twitter posts
$request = array(
    'count' => '10',
    'screen_name' => 'ukranews_com',
    'tweet_mode' => 'extended'
);


$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_nonce' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_token' => $oauth_access_token,
    'oauth_timestamp' => time(),
    'oauth_version' => '1.0',
);
 
// combine request and oauth in one array
$oauth = array_merge($oauth, $request);
 
// make base string
$baseURI="https://api.twitter.com/1.1/statuses/$twitter_timeline.json";
$method="GET";
$params=$oauth;
 
$r = array();
ksort($params);
foreach($params as $key=>$value){
    $r[] = "$key=" . rawurlencode($value);
}
$base_info = $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
 
// get oauth signature
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;

// make request
// make auth header
$r = 'Authorization: OAuth ';
 
$values = array();
foreach($oauth as $key=>$value){
    $values[] = "$key=\"" . rawurlencode($value) . "\"";
}
$r .= implode(', ', $values);

// get auth header
$header = array($r, 'Expect:');
//test($header);  
// set cURL options
$options = array(
    CURLOPT_HTTPHEADER => $header,
    CURLOPT_HEADER => false,
    CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
);
// retrieve the twitter feed
$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);
 
// decode json format tweets
$tweets=json_decode($json, true);
if($tweets){
    foreach($tweets as $tweet){
        test($tweet["full_text"],0);
    }
}
//test("=====");
test($tweets);  
*/
