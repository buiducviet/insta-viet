<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator, Session, Redirect, Auth;
use Intervention\Image\ImageManagerStatic as Img;

class UserController extends Controller
{
    function index(){
        $result = User::paginate(20);
        return view('admin.user.index', compact('result'));
    }
    function create(){
        return view('admin.user.create');
    }
    function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|unique:users,email',
            'password' => 'required'
            ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }else{
            $data['password'] = bcrypt($data['password']);
            $result = User::create($data);
            if ($result) {
                // Thumb:
                if (\Request::hasFile('thumb')) {
                    if (!is_dir('uploads')) {
                        mkdir('uploads', 0777);
                    }
                    $uploadDir = 'uploads/';
                    $fileName = $data['thumb']->getClientOriginalName();
                    $extension = $data['thumb']->getClientOriginalExtension();
                    $allowedExtensions = array('jpeg', 'jpg', 'png', 'bmp', 'gif');
                    $file_rename   = 'avatar-'. $result->id. '.'.$extension;
                    if(in_array($extension, $allowedExtensions)){
                        $data['thumb']->move($uploadDir, $file_rename);
                    }
                    $result->avatar = $this->imageOptimize($uploadDir.$file_rename, 200, 200, null, true);
                    $result->save();
                }
                Session::flash('message', 'created!');
            }
        }
        return Redirect::route('admin_user');
    }
    function edit($id){
        $result = User::find($id);
        if (is_null($result)) {
            Session::flash('message', 'Not isset id '.$id.'!');
            return Redirect::route('admin_user');
        }
        return view('admin.user.edit', compact('result'));
    }
    function update($id, Request $request){
        $data = $request->all();
        unset($data['_token']);
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            ]);
        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $result = User::find($id);
        if (\Request::hasFile('thumb')) {
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777);
            }
            $uploadDir = 'uploads/';
            $fileName = $data['thumb']->getClientOriginalName();
            $extension = $data['thumb']->getClientOriginalExtension();
            $allowedExtensions = array('jpeg', 'jpg', 'png', 'bmp', 'gif');
            $file_rename   = 'avatar-'. $result->id. '.'.$extension;
            if(in_array($extension, $allowedExtensions)){
                $data['thumb']->move($uploadDir, $file_rename);
            }
            $data['avatar'] = $this->imageOptimize($uploadDir.$file_rename, 200, 200, null, true);
            unset($data['thumb']);
        }
        if (!is_null($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        
        $result->fill($data);
        $result->save();
        Session::flash('message', 'updated!');
        return Redirect::route('admin_user');
    }
    function delete($id){
        $result = User::where('id', $id)->first();
        if (!is_null($result) and Auth::user()->id != $id) {
            if (file_exists(ltrim($result->avatar, '/'))) {
                unlink(ltrim($result->avatar, '/'));
            }
            $result->delete();
            Session::flash('message', 'deleted!');
        }
        return Redirect::back();
    }

    function imageOptimize($path, $max_width, $max_height, $server=null, $crop=false){
        $width = Img::make($path)->width();
        $height = Img::make($path)->height();
        if ($crop) {
            if ($width/$height < $max_width/$max_height) {
                $image = Img::make($path)->resize($width, NULL, function ($constraint) {
                                                                $constraint->aspectRatio();
                                                            })->save($path);
                $image->crop($width, round($max_height*$width/$max_width))->save($path);
            }else{
                $image = Img::make($path)->resize(NULL, $height, function ($constraint) {
                                                                $constraint->aspectRatio();
                                                            })->save($path);
                $image->crop(round($height*$max_width/$max_height), $height)->save($path);
            }
            if ($width > $max_width) {
                $image = Img::make($path)->resize($max_width, NULL, function ($constraint) {
                                                                $constraint->aspectRatio();
                                                            })->save($path);
            }
        }elseif($max_width > $width or $max_height > $height){
            if ($max_width/$width < $max_height/$height) {
                $image = Img::make($path)->resize($width, NULL, function ($constraint) {
                                                                $constraint->aspectRatio();
                                                            })->save($path);
            }else{
                $image = Img::make($path)->resize(NULL, $height, function ($constraint) {
                                                                $constraint->aspectRatio();
                                                            })->save($path);
            }
        }
        $image_thumb = is_null($server)?  '/'.$path: Server::uploadFtp($path, null, $server->id);
        return $image_thumb;
    }
}
