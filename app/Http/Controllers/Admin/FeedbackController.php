<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Validator;

class FeedbackController extends Controller
{
    function index(){
        $result = Feedback::orderBy('id', 'desc');
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $result->where('name', 'like', "%$q%")->orWhere('email', 'like', "%$q%")->orWhere('message', 'like', "%$q%");
        }
        $result = $result->paginate(50);
        $result->appends($_GET);
        return view('admin.feedback.index', compact('result'));
    }

    function edit($id){
    	$result = Feedback::where('id', $id)->first();
    	if (isset($_GET['status'])) {
    		$result->status = $_GET['status'];
            $result->save();
    		return redirect()->back();
    	}
    	return view('admin.feedback.edit', compact('result'));
    }
}
