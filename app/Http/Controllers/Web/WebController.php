<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\category;

class WebController extends Controller
{
    
	public function index()
	{

		return view('web.home');

	}

	

}
