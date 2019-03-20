<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Group;
use App\Models\Tag;
use App\Models\Setting;
use App\Helper;
use Validator;

class ClientController extends Controller
{
    function index(){
        $result = Client::orderBy('id', 'desc')->with('groups')->paginate(50);
        return view('admin.client.index', compact('result'));
    }

    function edit($id){
    	$result = Client::where('id', $id)->with('groups', 'menus', 'blocks')->first();
    	if (isset($_GET['delete'])) {
    		$result->delete();
    		return redirect()->back();
    	}
    	$groups = Group::all();
        if (!is_null($result)) {
            $setting = Setting::firstOrCreate(['title' => 'Quảng cáo', 'type' => 'ads', 'client_id' => $result->id]);
            $ads = is_array($setting->content)? $setting->content: [];
        }else{
            $ads = [];
        }
        $articles =  Setting::where(['type' => 'article', 'client_id' => is_null($result)? 0: $result->id])->get();
    	return view('admin.client.edit', compact('result', 'groups', 'ads', 'articles'));
    }

    function update(Request $request){
    	$data = $request->all();
    	$valid = isset($data['id'])? ','.$data['id']: '';
    	$validator = Validator::make($data, [
            'host' => 'required|unique:clients,host'.$valid,
        ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if (isset($data['id'])) {
            $result = Client::find(intval($data['id']));
        }else{
            $result = Client::firstOrCreate(['host' => $data['host']]);
        }
        $dir = 'webs/'.str_slug($data['host']);
        if (isset($data['image_src'])) {
            $image_src = Helper::upload_image($data['image_src'], $dir, 'image-src');
            if ($image_src) {
                $data['setting']['image_src'] = $image_src.'?v='.time();
            }
        }
        if (isset($data['logo'])) {
            $logo = Helper::upload_image($data['logo'], $dir, 'logo');
            if ($logo) {
                $data['setting']['logo'] = $logo.'?v='.time();
            }
        }
        if (isset($data['banner'])) {
            $banner = Helper::upload_image($data['banner'], $dir, 'banner');
            if ($banner) {
                $data['setting']['banner'] = $banner.'?v='.time();
            }
        }
        if (isset($data['icon'])) {
            $icon = Helper::upload_image($data['icon'], $dir, 'icon');
            if ($icon) {
                $data['setting']['icon'] = $icon.'?v='.time();
            }
        }
        if (isset($data['css'])) {
            $css = Helper::upload($data['css'], $dir, 'custom-css');
            if ($css) {
                $data['setting']['css'] = $css.'?v='.time();
            }
        }
        if (isset($data['setting']['blocks'])) {
            $data['setting']['blocks'] = array_where($data['setting']['blocks'], function($value, $key){
                return (!is_null($value['name']) || !is_null($value['tags']));
            });
        }
        $data['setting'] = array_merge(is_array($result->setting)? $result->setting: [], $data['setting']);
        $result->fill($data);
        $result->save();

        if (isset($data['group_ids'])) {
            $result->groups()->sync(array_map('intval', $data['group_ids']));
        }

        $setting = Setting::firstOrCreate(['title' => 'Quảng cáo', 'type' => 'ads', 'client_id' => $result->id]);
        $setting->fill(['content' => $data['ads']]);
        $setting->save();
        foreach ($data['article'] as $key => $item) {
            $setting = Setting::firstOrCreate(['slug' => $key, 'client_id' => $result->id, 'type' => 'article']);
            $setting ->fill([
                'content' => ['content' => $item],
            ]);
            $setting->save();
        }
        session()->flash('message', 'updated!');
        return redirect()->route('clients');
    }
}
