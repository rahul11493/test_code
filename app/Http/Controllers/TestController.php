<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TreeEntry;

class TestController extends Controller
{
		
    function index(){
		$results = TreeEntry::get();		
		return view('tree',compact('results'));	
    }		
	
	
	
}
