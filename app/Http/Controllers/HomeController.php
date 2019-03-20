<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \InstagramScraper\Instagram;
use \App\Models\Account;
use \App\Models\Top;
use \App\Models\Setting;
use MetaTag;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class HomeController extends Controller
{
    protected $instagram;
    protected $ig;
    protected $rankToken;

    function __construct(){
        if (!is_dir('cache')) {
            mkdir('cache', '0777', true);
        }
    }

    function get_proxy(){
        $proxy = false;
        if (strlen(env('PROXY_API'))) {
            $proxy_url = env('PROXY_API');
            if (strlen(env('PROXY_API_KEY'))) {
                if (str_contains($proxy_url, 'pubproxy.com')) {
                    $proxy_url .= "&api=".env('PROXY_API_KEY');
                }elseif (str_contains($proxy_url, 'getproxylist.com')) {
                    $proxy_url .= "&apiKey=".env('PROXY_API_KEY');
                }
            }

            try {
                $json = json_decode(file_get_contents($proxy_url));
                if ($json) {
                    if (isset($json->ip)) {
                        $proxy = $json;
                    }elseif (isset($json->data[0])) {
                        $proxy = $json->data[0];
                    }
                }
            } catch (\Exception $e) {
            }
        }elseif (strlen(env('IG_PROXY_ADDRESS'))) {
            $proxy = json_decode(json_encode(['ip' => env('IG_PROXY_ADDRESS'), 'port' => env('IG_PROXY_POSRT')]));
        }
        $this->proxy = $proxy;
        return $proxy;
    }

    function init_instagram($login = false){
        if ($login) {
            if (!cache()->has('account')) {
                $account = Account::where('client_id', config('config.client_id'))->orderBy('order', 'asc')->first();
                if (is_null($account)) {
                    $account->order = time();
                    $account->save();
                }
                cache(['account' => $account], env('CACHE_TIME', 5));
            }
            $account = cache('account');
            if (!is_null($account)) {
                $this->instagram = Instagram::withCredentials($account->username, $account->password, public_path('cache'));
                $this->instagram->login();
            }else{
                $login = false;
            }
        }
        if (!$login) {
            $this->instagram = new Instagram();

        }
        $proxy = $this->get_proxy();
        if ($proxy) {
            $proxy_config = [
                'address' => $proxy->ip,
                'port'    => $proxy->port,
                'tunnel'  => true,
                'timeout' => 30
            ];

            Instagram::setProxy($proxy_config);
        }
    }

    function init_ig(){
        if (!cache()->has('account')) {
            $account = Account::where('client_id', config('config.client_id'))->orderBy('order', 'asc')->first();
            if (is_null($account)) {
                $account->order = time();
                $account->save();
            }
            cache(['account' => $account], env('CACHE_TIME', 5));
        }
        
        $account = cache('account');
        $username = $account->username;
        $password = $account->password;
        $debug = false;
        $truncatedDebug = false;
        //////////////////////
        \InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
        $this->ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
        $this->ig->login($username, $password);
        if (strlen(env('IG_PROXY'))) {
            $this->ig->setProxy(env('IG_PROXY'));
        }elseif (strlen(env('PROXY_API'))) {
            $proxy_url = env('PROXY_API');
            if (strlen(env('PROXY_API_KEY'))) {
                $proxy_url .= "&apiKey=".env('PROXY_API_KEY');
            }
            try {
                $json = json_decode(file_get_contents($proxy_url));
                if ($json && isset($json->ip)) {
                    $protocal = isset($json->protocol)? $json->protocol: 'http';
                    $this->ig->setProxy("{$protocal}://{$json->ip}:{$json->port}");
                }
            } catch (\Exception $e) {
                
            }
        }
        $this->rankToken = \InstagramAPI\Signatures::generateUUID();
    }

    public function index()
    {
        if (isset($_GET['test'])) {
            dd(json_decode(\App\Helper::get_str(\App\Helper::curl('https://www.instagram.com/alenpalander'), 'window._sharedData = ', ';</script>')));
            $form = $crawler->selectButton('Download')->form();
            $crawler = $client->submit($form, array('URL' => 'https://twitter.com/i/status/1073916697151766528'));
            dd($crawler->filter('.col-md-8')->html());
        }

        if (!cache()->has('popular_photos_1')) {
            $this->init_ig();
            $feed = $this->ig->discover->getExploreFeed(1);

            cache(['popular_photos_1' => $feed->getItems()], env('CACHE_TIME', 5));
        }
        $medias = cache('popular_photos_1');
        return view('home', compact('medias'));
    }

    function base_search(){
        $popular_tags = explode(',', MetaTag::get('popular_tags'));
        $key = array_random($popular_tags);
        if (!cache()->has('base_search_'.$key)) {
            $url = 'https://www.instagram.com/web/search/topsearch/?'.http_build_query([
                'query' => $key,
                'context' => 'blended',
            ]);
            $search = \App\Helper::curl($url);
            $result = json_decode($search);
            cache(['base_search_'.$key => $result], env('CACHE_TIME', 10));
        }
        $result = cache('base_search_'.$key);
        $breadcrumb = [
            ['title' => 'Search result for "'.$key.'"', 'url' => null],
        ];
        MetaTag::set('title', str_replace('_title_', '', config('config.seo.search.title')));
        MetaTag::set('description', str_replace('_desc_', '', config('config.seo.search.description')));

        return view('search', compact('result', 'breadcrumb'));
    }

    function search($key = false){
        if (!$key) {
            $key = $_GET['q'];
        }
        $key = str_replace('+', ' ', $key);
        $url = 'https://www.instagram.com/web/search/topsearch/?'.http_build_query(['query' => $key]);
        $search = \App\Helper::curl($url);
        $result = json_decode($search);
        $breadcrumb = [
            ['title' => 'Search result for "'.$key.'"', 'url' => null],
        ];

        MetaTag::set('title', str_replace('_title_', 'Result for '.$key, config('config.seo.search.title')));
        MetaTag::set('description', str_replace('_desc_', 'Result for '.$key, config('config.seo.search.description')));

        return view('search', compact('result', 'breadcrumb'));
    }

    function popular_users(){
        if (!cache()->has('top_users')) {
            $result = Top::orderBy('follower', 'desc')->take(100)->get();
            cache(['top_users' => $result], env('CACHE_TIME', 5));
        }
        $result = cache('top_users');
        $breadcrumb = [
            ['title' => 'Popular users', 'url' => null],
        ];

        MetaTag::set('title', str_replace('_title_', '', config('config.menu.popular_users.title')));
        MetaTag::set('description', str_replace('_desc_', '', config('config.menu.popular_users.description')));
        return view('popular-users', compact('result', 'breadcrumb'));
    }

    function location_search($key){
        $url = 'https://www.instagram.com/web/search/topsearch/?'.http_build_query([
            'query' => $key,
            'context' => 'blended',
        ]);
        $search = \App\Helper::curl($url);
        $search = json_decode($search);
        if (isset($search->places[0])) {
            $location = $search->places[0]->place->location;
            $this->init_ig();
            if (isset($location->lat)) {
                $places = $this->ig->location->findPlacesNearby($location->lat, $location->lng)->getItems();
            }
        }
        $breadcrumb = [
            ['title' => 'Location', 'url' => route('locations')],
            ['title' => 'Search '.$key.' locations', 'url' => null],
        ];

        MetaTag::set('title', str_replace('_title_', "Result for {$key} location", config('config.seo.search.title')));
        MetaTag::set('description', str_replace('_desc_', "Result for {$key} location", config('config.seo.search.description')));

        return view('location-search', compact('location', 'places', 'key', 'breadcrumb'));
    }

    function locations(){
        $locations = explode(',', MetaTag::get('popular_locations'));
        $location_name = array_random($locations);
        if (!cache()->has('location_'.$location_name)) {
            $url = 'https://www.instagram.com/web/search/topsearch/?'.http_build_query([
                'query' => $location_name,
                'context' => 'blended',
            ]);
            $search = \App\Helper::curl($url);
            $search = json_decode($search);
            if (isset($search->places[0])) {
                $location = $search->places[0]->place->location;
                $this->init_ig();
                $places = $this->ig->location->findPlacesNearby($location->lat, $location->lng)->getItems();
                $feed = $this->ig->location->getFeed($location->pk, $this->rankToken);
                $medias = $feed->getRanked_items();
            }
            cache(['location_'.$location_name => compact('places', 'medias', 'location')], env('CACHE_TIME', 10));
        }
        $result = cache('location_'.$location_name);
        $result['breadcrumb'] = [
            ['title' => 'Favorite locations', 'url' => null],
        ];

        MetaTag::set('title', str_replace('_title_', '', config('config.menu.locations.title')));
        MetaTag::set('description', str_replace('_desc_', '', config('config.menu.locations.description')));

        return view('popular-locations', $result);
    }

    function location_feed($id){
        $id = array_last(explode('-', $id));
        $this->init_ig();
        $feed = $this->ig->location->getFeed($id, $this->rankToken, isset($_GET['page'])? $_GET['page']: null);
        
        $breadcrumb = [
            ['title' => 'Location', 'url' => route('locations')],
            ['title' => $feed->getLocation()->getShort_name(), 'url' => null],
        ];
        $places = $this->ig->location->findPlacesNearby($feed->getLocation()->getLat(), $feed->getLocation()->getLng())->getItems();
        
        if (!is_null($feed->getStory()) && strlen($feed->getStory()->getLocation()->getProfile_pic_url())) {
            MetaTag::set('image_src', $feed->getStory()->getLocation()->getProfile_pic_url());
        }
        MetaTag::set('title', str_replace('_title_', $feed->getLocation()->getShort_name(), config('config.seo.location.title')));
        MetaTag::set('description', str_replace('_desc_', $feed->getLocation()->getShort_name(), config('config.seo.location.description')));

        return view('location', compact('breadcrumb', 'feed', 'places'));
    }

    function tag($tagName){
        $this->init_ig();
        $breadcrumb = [
            ['title' => '#'.$tagName.' feeds', 'url' => null],
        ];
        $page = isset($_GET['page'])? $_GET['page']: null;
        $result = $this->ig->hashtag->getFeed($tagName, $this->rankToken, isset($_GET['page'])? $_GET['page']: null);
        if (!is_null($result->getStory()) && strlen($result->getStory()->getOwner()->getProfile_pic_url())) {
            MetaTag::set('image_src', $result->getStory()->getOwner()->getProfile_pic_url());
        }
        MetaTag::set('title', str_replace('_title_', "#{$tagName}", config('config.seo.tag.title')).(isset($_GET['page'])? " page {$_GET['page']}": ''));
        MetaTag::set('description', str_replace('_desc_', "#{$tagName}", config('config.seo.tag.description')));

        return view('tag', compact('breadcrumb', 'result', 'tagName'));
    }

    function popular_photos(){
        $page = isset($_GET['page'])? $_GET['page']: 1;
        if (!cache()->has('popular_photos_'.$page)) {
            $this->init_ig();
            $feed = $this->ig->discover->getExploreFeed($_GET['page']);

            cache(['popular_photos_'.$_GET['page'] => $feed->getItems()], env('CACHE_TIME', 5));
        }
        $medias = cache('popular_photos_'.$page);
        $seo_page = $page > 1? "Page {$page} - ": '';
        MetaTag::set('title', str_replace('_title_', '', $seo_page.config('config.menu.trending_photo.title')));
        MetaTag::set('description', str_replace('_desc_', '', config('config.menu.trending_photo.description')));

        $breadcrumb = [
            ['title' => 'Discovery', 'url' => null],
        ];
        return view('popular-photos', compact('medias', 'breadcrumb'));
    }

    function post($slug){
        $code = substr($slug, strrpos($slug, '-p-') + 3);
        $this->init_instagram();
        $media = $this->instagram->getMediaByCode($code);
        $account = $media->getOwner();
        // $account_media = $this->instagram->getMedias($account->getUsername(), 12);
        // $medias = $account_media['medias'];

        $breadcrumb = [
            ['title' => $account->getUsername(), 'url' => route('user', $account->getUsername())],
            ['title' => $account->getUsername()." 's feed at ".date('Y/m/d H:i', $media->getCreatedTime()), 'url' => null],
        ];

        if (strlen($media->imageThumbnailUrl)) {
            MetaTag::set('image_src', $media->imageThumbnailUrl);
        }
        MetaTag::set('title', str_replace('_title_', "@{$account->getUsername()} ".date('Y/m/d H:i', $media->getCreatedTime()), config('config.seo.post.title')));
        MetaTag::set('description', str_replace('_desc_', "@{$account->getUsername()} ".date('Y/m/d H:i', $media->getCreatedTime()), config('config.seo.post.description')));

        return view('post', compact('media', 'breadcrumb', 'account', 'medias'));
    }

    function user($username){
        // $this->init_ig();
        // $user = $this->ig->people->getInfoByName($username);
        // dd($this->ig->story->getUserStoryFeed($user->getUser()->getPk()));
        // dd($user, $this->ig->people->getSuggestedUsers($user->getUser()->getPk()));
        $this->init_instagram();
        $result = $this->instagram->getPaginateMedias($username);
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $str = $alphabet[rand(0, strlen($alphabet)-1)];
        if (!cache()->has('similar_'.$str)) {
            $similar = $this->instagram->searchAccountsByUsername($str);
            foreach (collect($similar)->where('followedByCount', '>', 15000000) as $key => $value) {
                $top = Top::firstOrCreate(['username' => $value->getUsername()]);
                $top->fill([
                    'name' => $value->getFullName(),
                    'key' => $value->getId(),
                    'follower' => $value->getFollowedByCount(),
                    'following' => $value->getFollowsCount(),
                    'media' => $value->getMediaCount(),
                    'avatar' => $value->getProfilePicUrl(),
                ])->save();
            }
            cache(['similar_'.$str => collect($similar)->sortByDesc('followedByCount')], 10080);
        }
        $result['similar'] = cache('similar_'.$str);

        $result['breadcrumb'] = [
            ['title' => 'Users', 'url' => route('popular_users')],
            ['title' => $username." 's story", 'url' => null],
        ];
        if (strlen($result['account']->getProfilePicUrlHd())) {
            MetaTag::set('image_src', $result['account']->getProfilePicUrlHd());
        }
        
        MetaTag::set('title', str_replace('_title_', "@{$username} {$result['account']->getFullName()}", config('config.seo.user.title')));
        MetaTag::set('description', str_replace('_desc_', "@{$username} {$result['account']->getFullName()}", config('config.seo.user.description')));

        return view('user', $result);
    }

    function profile(){
        MetaTag::set('title', "My account");
        MetaTag::set('robots', 'noindex, nofollow');
    	return view('profile');
    }

    function contact(){
        if (!cache()->has('contact')) {
            $setting = Setting::where(['slug' => 'contact', 'client_id' => config('config.client_id')])->first();
            cache(['contact' => $setting->content], env('CACHE_TIME', 5));
        }
        $result = cache('contact');
        MetaTag::set('title', 'Contact us - '.MetaTag::get('title'));
        return view('contact', compact('result'));
    }

    function term(){
        if (!cache()->has('term')) {
            $setting = Setting::where(['slug' => 'term', 'client_id' => config('config.client_id')])->first();
            cache(['term' => $setting->content], env('CACHE_TIME', 5));
        }
        $result = cache('term');
        MetaTag::set('title', 'Privacy Policy - '.MetaTag::get('title'));
        return view('term', compact('result'));
    }
}
