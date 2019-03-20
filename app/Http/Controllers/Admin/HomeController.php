<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    function index(){
        $result = User::orderBy('id', 'desc')->paginate(20);
        return view('admin.user.index', compact('result'));
    }
}
