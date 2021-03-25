<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Response;

class SearchController extends Controller
{
    public function autocomplete(){
	$term = Input::get('amember');
	
	$results = array();
	
	$queries = DB::table('auditors')
		->where('name', 'LIKE', '%'.$term.'%')
		->orWhere('email', 'LIKE', '%'.$term.'%')
		->take(5)->get();
	
		foreach ($queries as $query){
		    $results[] = [ 'name' => $query->name ];
		}
		return Response::json($results);
	}
}
