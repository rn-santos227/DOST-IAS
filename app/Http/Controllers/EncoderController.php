<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\encoder;
use App\User;
use View;
use DB;
use Carbon\Carbon;
use Session;

class EncoderController extends Controller
{
    public function index(){
    	$encoders = Encoder::get();
        return View::make("encoder")->with('encoders', $encoders);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $u_encoder = User::create([
            'title' => ' ',
            'name' => $request['name'],
            'username' => $request['username'],
            'nickname' => ' ',
            'email' => $request['email'],
            'agency' => ' ',
            'position' => ' ',
            'agency_email' => ' ',
            'contact' => ' ',
            'role' => $request['role'],
            'password' => bcrypt($request['password']),
        ]);

        $id = $u_encoder->id;

        $encoder = Encoder::create([
            'user_id' => $id,
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
        ]);

        return response()->json($encoder);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, $user_type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $e = Encoder::where('user_id', $id)
        ->update(array('name'=> $request['u_name'],
                    'username'=>$request['u_username'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        User::where('id', $id)
        ->update(array('name'=> $request['u_name'],
                    'username'=>$request['u_username'], 
                    'email'=>$request['u_email'],
                    'updated_at'=>Carbon::now()));

        $u_encoder = User::findOrFail($id);  

        return json_encode($u_encoder);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
