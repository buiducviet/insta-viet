<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Account;
use App\Models\Client;
use App\Models\Top;
use App\Models\STag;
use App\Models\SUser;
use App\Helper;
use Auth, Img;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Sunra\PhpSimple\HtmlDomParser;
use \InstagramScraper\Instagram;

class SettingController extends Controller
{
    protected $ig;
    protected $rankToken;
    protected $host;

    function init_ig(){
        if (!cache()->has('client')) {
            $client = Client::where('host', $this->host)->first();
            cache(['client' => $client], env('CACHE_TIME', 5));
        }
        $client = cache('client');
        if (!cache()->has('account')) {
            $account = Account::where('client_id', $client->id)->orderBy('order', 'asc')->first();
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
        // if (strlen(env('IG_PROXY'))) {
        //     $this->ig->setProxy(env('IG_PROXY'));
        // }
        $this->rankToken = \InstagramAPI\Signatures::generateUUID();
    }
    function popular_user(){
        $result = Top::orderBy('follower', 'desc')->paginate(100);
        return view('admin.setting.popular-user', compact('result'));
    }

    function update_popular_user($id){
        $user = Top::find($id);
        if (isset($_GET['delete'])) {
            $user->delete();
        }elseif (isset($_GET['refresh'])) {
            if (!is_dir('cache')) {
                mkdir('cache', 0777, true);
            }
            $instagram   = new Instagram();
            $data = $instagram->getPaginateMedias($user->username);
            $result = $data['account'];
            $img = Helper::upload_url($result->getProfilePicUrl(), 'popular-users', $result->getUserName());
            $avatar = $img? $img.'?'.time(): null;
            $user->fill([
                'name' => $result->getFullName(),
                'key' => $result->getId(),
                'follower' => $result->getFollowedByCount(),
                'following' => $result->getFollowsCount(),
                'media' => $result->getMediaCount(),
                'avatar' => $avatar,
            ]);
            $user->save();
        }
        return response()->json($user);
    }

    function edit_popular_user(Request $request, $id){
        $data = $request->all();
        if ($id == 0) {
            $users = explode(',', $data['users']);
            foreach ($users as $key => $username) {
                if(strlen(trim($username))){
                    $user[] = Top::firstOrCreate(['username' => trim($username)]);
                }
            }
            session()->flash('message', 'Đã thêm thành công');
            return redirect()->route('setting_popular_user');
        }else{
            
        }
    }

    function account(){
        $result = Account::orderBy('id', 'desc');
        if (isset($_GET['q'])) {
            $result->where('username', 'like', "%{$_GET['q']}%");
        }
        $result = $result->with('client')->paginate(50);
        $result->appends($_GET);
        return view('admin.setting.acount', compact('result'));
    }

    function edit_account($id){
        $result = Account::find($id);
        if (isset($_GET['delete'])) {
            $result->delete();
            return redirect()->back();
        }
        $clients = Client::select('id', 'host')->get(); 
        return view('admin.setting.account-edit', compact('result', 'clients'));
    }

    function update_account(Request $request, $id){
        $data = $request->all();
        if ($id == 0) {
            $result = Account::firstOrCreate(['username' => $data['username']]);
        }else{
            $result = Account::find($id);
        }
        $result->fill($data);
        $result->save();
        return redirect()->route('setting_account');
    }

    function sitemap_tags(Request $request){
        if (isset($_GET['craw'])) {
            $this->host = $request->getHttpHost();
            $this->init_ig();
            $feed = $this->ig->discover->getExploreFeed($_GET['craw']);
            foreach ($feed->getItems() as $key => $item) {
                if(!$item->getMedia()->getUser()->getIs_private()){
                    SUser::firstOrCreate(['key' => $item->getMedia()->getUser()->getUsername()]);
                }
                if (!is_null($item->getMedia()->getCaption())) {
                    if (preg_match_all('~(#\w+)~', $item->getMedia()->getCaption()->getText(), $matches, PREG_PATTERN_ORDER)) {
                        foreach ($matches[1] as $tag) {
                            STag::firstOrCreate(['key' => str_slug($tag)]);
                        }
                    }
                }
            }
            return response()->json(['message' => $feed->getNext_max_id()]);
        }

        $result = STag::orderBy('key', 'asc');
        if (isset($_GET['delete'])) {
            $result->where('id', intval($_GET['delete']))->delete();
            return redirect()->back();
        }
        if (isset($_GET['q'])) {
            $result->where('key', 'like', "%{$_GET['q']}%");
        }
        $result = $result->paginate(100);
        $result->appends($_GET);
        return view('admin.setting.sitemap-tags', compact('result'));
    }

    function update_sitemap_tags(Request $request){
        $data = $request->all();
        $tags = explode(',', $data['content']);
        foreach ($tags as $key => $value) {
            STag::firstOrCreate(['key' => trim($value)]);
        }
        return redirect()->back();
    }

    function sitemap_users(Request $request){

        $result = SUser::orderBy('key', 'asc');
        if (isset($_GET['delete'])) {
            $result->where('id', intval($_GET['delete']))->delete();
            return redirect()->back();
        }
        if (isset($_GET['q'])) {
            $result->where('key', 'like', "%{$_GET['q']}%");
        }
        $result = $result->paginate(100);
        $result->appends($_GET);
        return view('admin.setting.sitemap-users', compact('result'));
    }

    function update_sitemap_users(Request $request){
        $data = $request->all();
        $tags = explode(',', $data['content']);
        foreach ($tags as $key => $value) {
            SUser::firstOrCreate(['key' => trim($value)]);
        }
        return redirect()->back();
    }
}
