<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use DB;
use App\Models\News;

use Stichoza\GoogleTranslate\TranslateClient;
use Google\Cloud\Translate\TranslateClient as GoogleTranslateClient;

class NewsSyncJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $translateClient = null;
    public function __construct()
    {
    	$this->translateClient = new TranslateClient(null, 'en');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rsses = collect(DB::table("news_resources_rsses")->whereNull('deleted_at')->where('status', 1)->where('socia_network', 0)->get(["id", "title", "rss", "headline_ids", "last_sync", "sync_start", "sync_end"]))->keyBy("id");
        $headlines = collect(DB::table("news_headlines")->whereNull('deleted_at')->where('status', 1)->get(["id", "title_ua", "categories"]))->keyBy("id");
        if($rsses && $headlines){
          foreach($rsses as $rKey => $rItem){
          	if($rItem->sync_start != '0000-00-00 00:00:00' && $rItem->sync_end != '0000-00-00 00:00:00'){
          		if(strtotime($rItem->sync_start) > time() || strtotime($rItem->sync_end) < time()){
          			continue;
          		}
						}
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
              $rsses[$rKey]->headlines = $rItem->headlines;
              $rsses[$rKey]->headlines_categories = $rItem->headlines_categories;
              $rsses[$rKey]->headlines_categories_all = $rItem->headlines_categories_all;
              $rssNews = $this->getRSSFeeds($rItem->rss, $rItem);
              if($rssNews){
                foreach($rssNews as $newData){
                  $data = News::updateOrCreate(["guid" => $newData["guid"]], $newData);                  
                }
                DB::table("news_resources_rsses")->where("id", $rItem->id)->update(['last_sync' => date("Y-m-d H:i:s")]);
              }
            }
          }
        }   
        exit("Done");
    }
    
    
    public function getRSSFeeds($rssURL, $rssObject){
       $rss = @simplexml_load_file($rssURL);
       $news = array();
       $k = 0;
       
       if(isset($rss->channel->item)){
         foreach($rss->channel->item as $item) {
            $pubDate = (string)$item->pubDate;
            if(isset($pubDate) && strtotime($pubDate) > strtotime($rssObject->last_sync)){
              $category = (string)$item->category;
              $category = trim($category);
              if(!in_array($category, $rssObject->headlines_categories_all)){
                continue;
              }
              foreach($rssObject->headlines_categories as $hcKey => $hcItem){
                if(in_array($category, $hcItem)){
                  $guID = trim($item->guid);
                  $guID = $guID ? $guID : trim($item->link);
                  $news[$k]["headline_id"] = $hcKey;
                  $news[$k]["resource_id"] = $rssObject->id;
                  $news[$k]["title_ua"] = trim($item->title);
                  $news[$k]["title_ru"] = trim($item->title);
                  try{
                  	$news[$k]["title_en"] = $this->translateClient->translate(trim($item->title));
                  }catch(Exception $e){
                  	$news[$k]["title_en"] = "";
                  }
                  $news[$k]["guid"] = $guID;
                  $news[$k]["link"] = trim($item->link);
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
    
}
