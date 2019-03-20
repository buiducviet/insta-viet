<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Group;
use Validator;

class TagController extends Controller
{
    function index(){
        $result = Tag::with('childs', 'groups')->orderBy('id', 'desc');
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $result->where('name', 'like', "%$q%");
        }else{
            $result->whereNull('parent_id');
        }
        $result = $result->paginate(50);
        $result->appends($_GET);
        return view('admin.tag.index', compact('result'));
    }

    function edit($id){
    	$result = Tag::where('id', $id)->first();
    	if (isset($_GET['delete'])) {
    		$result->delete();
    		return redirect()->back();
    	}
        $parents = Tag::whereNull('parent_id')->get();
        $groups = Group::all();
    	return view('admin.tag.edit', compact('result', 'parents', 'groups'));
    }

    function update(Request $request){
    	$data = $request->all();
    	$valid = isset($data['id'])? ','.$data['id']: '';
    	$validator = Validator::make($data, [
            'slug' => 'required|unique:tags,slug'.$valid,
        ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['slug'] = str_slug($data['slug']);
        if (isset($data['id'])) {
            $result = Tag::find(intval($data['id']));
        }else{
            $result = Tag::firstOrCreate(['slug' => $data['slug']]);
        }
        $result->fill($data);
        $result->save();
        if (isset($data['group_ids'])) {
            $result->groups()->sync(array_map('intval', $data['group_ids']));
        }
        session()->flash('message', 'updated!');
        return redirect()->route('admin_tags');
    }
}
