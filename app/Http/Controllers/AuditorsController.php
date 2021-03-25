<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\auditors;
use App\User;
use View;
use DB;
use Carbon\Carbon;
use Session;

class AuditorsController extends Controller
{
    public function index(){
    	$auditors = Auditors::get();
        return View::make("auditors")->with('auditors', $auditors);
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
            'agency' => $request['agency'],
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

        // dd($id);

        $iasstaff = Auditors::create([
            'user_id' => $id,
            'title' => $request['title'],
            'name' => $request['name'],
            'username' => $request['username'],
            'agency' => $request['agency'],
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
        Auditors::where('id', $id)
        ->update(array('title'=> $request['u_title'],
        			'name'=> $request['u_name'],
                    'username'=>$request['u_username'], 
                    'agency'=>$request['u_agency'], 
                    'position'=>$request['u_position'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        User::where('id', $id)
        ->update(array('title'=> $request['u_title'],
        			'name'=> $request['u_name'],
                    'username'=>$request['u_username'], 
                    'agency'=>$request['u_agency'], 
                    'position'=>$request['u_position'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        $u_iasstaff = User::findOrFail($id);  

        return json_encode($u_iasstaff);

    }
}
