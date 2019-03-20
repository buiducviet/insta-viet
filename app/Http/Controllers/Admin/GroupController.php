<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Validator;

class GroupController extends Controller
{
    function index(){
        $result = Group::orderBy('id', 'desc')->paginate(50);
        return view('admin.group.index', compact('result'));
    }

    function edit($id){
    	$result = Group::where('id', $id)->first();
    	if (isset($_GET['delete'])) {
    		$result->delete();
    		return redirect()->back();
    	}
    	return view('admin.group.edit', compact('result'));
    }

    function update(Request $request){
    	$data = $request->all();
    	$valid = isset($data['id'])? ','.$data['id']: '';
    	$validator = Validator::make($data, [
            'name' => 'required|unique:groups,name'.$valid,
        ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if (isset($data['id'])) {
            $result = Group::find(intval($data['id']));
        }else{
            $result = Group::firstOrCreate(['name' => $data['name']]);
        }
        $result->fill($data);
        $result->save();
        session()->flash('message', 'updated!');
        return redirect()->route('groups');
    }
}
