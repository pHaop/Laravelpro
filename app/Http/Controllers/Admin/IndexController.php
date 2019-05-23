<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
    	// dump(session('code'));
    	// dump(session('id'));
    	return view('Admin.index');
    }
}
