<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \InstagramScraper\Instagram;
use \App\Models\Account;
use App\Models\Client;
use \App\Models\Top;
use \App\Models\Setting;
use \App\Models\STag;
use \App\Models\SUser;
use \App\Models\SLocation;
use \App\Models\SFeed;
use Illuminate\Pagination\Paginator;

class SitemapController extends Controller {
    const RATE_HOME          = '1.0';
    const RATE_CATEGORY      = '0.9';
    const RATE_DETAIL        = '0.8';
    const FREQUENCY_HOME     = 'always';
    const FREQUENCY_CATEGORY = 'always';
    const FREQUENCY_DETAIL   = 'daily';

    protected $perpage;

    function __construct(){
        $this->perpage = 2000;
    }

    public function index(Request $request) {
        $sitemap = \App::make("sitemap");

        // Current time
        $currentTime = \Carbon\Carbon::now(new \DateTimeZone('UTC'));

        // Home
        $sitemap->add(route('home'), $currentTime, self::RATE_HOME, self::FREQUENCY_HOME);

        // Level 2
        $sitemap->add(route('popular_users'), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        $sitemap->add(route('locations'), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        $sitemap->add(route('popular_photos'), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        $sitemap->add(route('base_search'), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        if (!cache()->has('client')) {
            $client = Client::where('host', $request->getHttpHost())->first();
            cache(['client' => $client], env('CACHE_TIME', 5));
        }
        $client = cache('client');
        if (!is_null($client)) {
            if (isset($client->setting['popular_tags'])) {
                foreach (explode(',', $client->setting['popular_tags']) as $key => $value) {
                    $sitemap->add(route('tag', str_slug($value, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
                }
            }
            if (isset($client->setting['blocks'])) {
                foreach ($client->setting['blocks'] as $block) {
                    foreach (explode(',', $block['tags']) as $key => $value) {
                        $sitemap->add(route('tag', str_slug($value, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
                    }
                }
            }
            if (isset($client->setting['popular_locations'])) {
                foreach (explode(',', $client->setting['popular_locations']) as $key => $value) {
                    $sitemap->add(route('location_search', str_slug($value, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
                }
            }
        }
        if (!cache()->has('top_users')) {
            $users = Top::orderBy('follower', 'desc')->take(100)->get();
            cache(['top_users' => $users], env('CACHE_TIME', 5));
        }
        $users = cache('top_users');
        foreach ($users as $key => $value) {
            $sitemap->add(route('user', $value->username), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }
        $tags = STag::paginate($this->perpage);
        for ($i = 1; $i <= $tags->lastPage(); $i++) { 
            $sitemap->add(route('sitemap_tag', $i), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        $users = SUser::paginate($this->perpage);
        for ($i = 1; $i <= $users->lastPage(); $i++) { 
            $sitemap->add(route('sitemap_user', $i), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        $locations = SLocation::paginate($this->perpage);
        for ($i = 1; $i <= $locations->lastPage(); $i++) { 
            $sitemap->add(route('sitemap_location', $i), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        $feed = SFeed::paginate($this->perpage);
        for ($i = 1; $i <= $feed->lastPage(); $i++) { 
            $sitemap->add(route('sitemap_feed', $i), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        return $sitemap->render('xml');
    }

    function feed($page){
        $sitemap = \App::make("sitemap");

        // Current time
        $currentTime = \Carbon\Carbon::now(new \DateTimeZone('UTC'));

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $result = SFeed::paginate($this->perpage);

        foreach ($result as $key => $value) {
            $sitemap->add(route('post', $value->slug), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        return $sitemap->render('xml');
    }

    function location($page){
        $sitemap = \App::make("sitemap");

        // Current time
        $currentTime = \Carbon\Carbon::now(new \DateTimeZone('UTC'));

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $result = SLocation::paginate($this->perpage);

        foreach ($result as $key => $value) {
            $sitemap->add(route('location_feed', str_slug($value->key, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        return $sitemap->render('xml');
    }

    function user($page){
        $sitemap = \App::make("sitemap");

        // Current time
        $currentTime = \Carbon\Carbon::now(new \DateTimeZone('UTC'));

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $result = SUser::paginate($this->perpage);

        foreach ($result as $key => $value) {
            $sitemap->add(route('user', str_slug($value->key, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        return $sitemap->render('xml');
    }

    function tag($page){
        $sitemap = \App::make("sitemap");

        // Current time
        $currentTime = \Carbon\Carbon::now(new \DateTimeZone('UTC'));

        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $result = STag::paginate($this->perpage);

        foreach ($result as $key => $value) {
            $sitemap->add(route('tag', str_slug($value->key, '')), $currentTime, self::RATE_CATEGORY, self::FREQUENCY_CATEGORY);
        }

        return $sitemap->render('xml');
    }
}
