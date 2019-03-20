<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Group;
use App\Models\Article;
use App\Helper;
use Validator;

class ArticleController extends Controller
{
    function index(){
        $result = Article::with('tags')->orderBy('id', 'desc');
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $result->where('name', 'like', "%$q%");
        }
        $result = $result->paginate(50);
        $result->appends($_GET);
        return view('admin.article.index', compact('result'));
    }

    function edit($id){
    	$result = Article::where('id', $id)->first();
    	if (isset($_GET['delete'])) {
    		$result->delete();
    		return redirect()->back();
    	}
        $tags = Tag::whereNull('parent_id')->with('childs')->get();
    	return view('admin.article.edit', compact('result', 'tags', 'id'));
    }

    function update(Request $request, $id){
    	$data = $request->all();
    	$valid = $id !== 0? ','.$id: '';
    	$validator = Validator::make($data, [
            'slug' => 'required|unique:articles,slug'.$valid,
        ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['slug'] = str_slug($data['slug']);
        if (isset($data['id'])) {
            $result = Article::find(intval($data['id']));
        }else{
            $result = Article::firstOrCreate(['slug' => $data['slug']]);
        }
        if (isset($data['thumb_file'])) {
            $thumb = Helper::upload_image($data['thumb_file'], 'storage/articles', $data['slug'].'-thumb-'.$result->id);
            if ($thumb) {
                $data['thumb'] = $thumb;
            }
        }
        $result->fill($data);
        $result->save();
        if (isset($data['tag_ids'])) {
            $result->tags()->sync(array_map('intval', $data['tag_ids']));
        }
        session()->flash('message', 'updated!');
        return redirect()->route('admin_article');
    }

    function upload(Request $request){
        $data = $request->all();
        $name = isset($data['name'])? $data['file']->getClientOriginalName(): uniqid();
        $image = Helper::upload_image($data['file'], 'storage/articles', $name);
        $result['status'] = $image? true: false;
        if ($image) {
            $result['link']   = Helper::media($image);
        }
        return response()->json($result);
    }
}
