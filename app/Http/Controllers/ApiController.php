<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \InstagramScraper\Instagram;
use \App\Models\Account;
use \App\Models\Feedback;
use \App\Models\Top;
use Validator;

class ApiController extends Controller
{
    protected $instagram;

    function __construct(){
        if (!is_dir('cache')) {
            mkdir('cache', '0777', true);
        }
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
        if (strlen(env('IG_PROXY_ADDRESS'))) {
            Instagram::setProxy([
                'address' => env('IG_PROXY_ADDRESS'),
                'port'    => env('IG_PROXY_POSRT'),
                'tunnel'  => true,
                'timeout' => 30,
                'auth' => [
                    'user' => env('IG_PROXY_USER'),
                    'pass' => env('IG_PROXY_PASS'),
                    'method' => CURLAUTH_BASIC
                ],
            ]);
        }
    }

    function index(){
        switch ($_GET['data']) {
            case 'account_media_pagination':
                return $this->account_media_pagination();
                break;
            case 'ads_banner':
                return $this->ads_banner();
                break;
            
            default:
                # code...
                break;
        }
    }

    function ads_banner(){
        if (!cache()->has('ads_banner')) {
            $user = Top::orderBy('sort', 'asc')->first();
            $this->init_instagram();
            $data = $this->instagram->getPaginateMedias($user->username);
            $result = $data['account'];
            $user->fill([
                'name' => $result->getFullName(),
                'key' => $result->getId(),
                'follower' => $result->getFollowedByCount(),
                'following' => $result->getFollowsCount(),
                'media' => $result->getMediaCount(),
                'avatar' => $result->getProfilePicUrl(),
                'sort' => time()
            ])->save();

            $medias = [];
            foreach (array_slice($data['medias'], 0, 4) as $key => $item) {
                $medias[] = [
                    'url' => \App\Helper::route_decode($item->getCaption(), $item->getShortCode()),
                    'thumb' => $item->getImageThumbnailUrl(),
                    'caption' => \App\Helper::caption_decode($item->getCaption()),
                    'time' => \App\Helper::time($item->getCreatedTime())
                ];
            }

            cache(['ads_banner' =>[
                'medias' => $medias,
                'account' => [
                    'url' => route('user', $user->username),
                    'avatar' => $user->avatar,
                    'username' => $user->username,
                    'name' => $user->username
                ]
            ]], 1);
        }
        $result = cache('ads_banner');
        header('Access-Control-Allow-Origin: *');
        return response()->json($result);
    }

    function account_media_pagination(){
        $this->init_instagram();
        $result = $this->instagram->getPaginateMedias(false, $_GET['maxId'], $_GET['userId']);
        return response()->json($result);
    }

    function contact(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
            'captcha' => 'required|captcha',
        ],
        [
            'captcha' => 'security number not match.'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $feed = Feedback::create($data);
        session()->flash('message', '<div class="alert alert-success">Your message has been successfully sent</div>');
        return redirect()->back();
    }
}
