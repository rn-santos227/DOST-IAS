<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\iasstaff;
use App\User;
use View;
use DB;
use Carbon\Carbon;
use Session;

class IASController extends Controller
{
    public function index(){
    	$iasstaffs = Iasstaff::get();
        return View::make("ias")->with('iasstaffs', $iasstaffs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $u_iasstaff = User::create([
            'title' => $request['title'],
            'name' => $request['name'],
            'username' => $request['username'],
            'position' => $request['position'],
            'email' => $request['email'],
            'nickname' => ' ',
            'agency' => ' ',
            'agency_email' => ' ',
            'contact' => ' ',
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
        ]);

        $id = $u_iasstaff->id;

        // dd($u_iasstaff);

        $iasstaff = Iasstaff::create([
            'user_id' => $id,
            'title' => $request['title'],
            'name' => $request['name'],
            'username' => $request['username'],
            'position' => $request['position'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
        ]);

        return response()->json($iasstaff);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Iasstaff::where('id', $id)
        ->update(array('title'=> $request['u_title'],
        			'name'=> $request['u_name'],
                    // 'username'=>$request['u_username'], 
                    'position'=>$request['u_position'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        User::where('id', $id)
        ->update(array('title'=> $request['u_title'],
        			'name'=> $request['u_name'],
                    // 'username'=>$request['u_username'], 
                    'position'=>$request['u_position'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        $u_iasstaff = User::findOrFail($id);  

        return json_encode($u_iasstaff);

    }
}
