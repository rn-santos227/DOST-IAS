<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\encoder;
use App\User;
use App\afrecommendation;
use View;
use DB;
use Carbon\Carbon;
use Session;
use Auth;

class AfrecommendationController extends Controller
{
    public function store(Request $request, $id){
        $afrecommendation = afrecommendation::create([
            'form_001_id' => $request['_ids'],
            'auditfinding_no' => $id,
            'subof_no' => '',
            'author_id' => Auth::user()->id,
            'afrecommend' => $request['findings_recommendation'],
            'management_action' => ' ',
            'status' => ' ',
            'created_at' => ' ',
            'updated_at' => ' ',
            'fauthor_id' => ' ',
            'first_fu' => ' ',
            'ffu_mgmtaction' => ' ',
            'ffu_status' => ' ',
            'ffu_updated_at' => ' ',
            'ffumgmt_updated_at' => ' ',
            'sauthor_id' => ' ',
            'second_fu' => ' ',
            'sfu_mgmtaction' => ' ',
            'sfu_status' => ' ',
            'sfu_updated_at' => ' ',
            'sfumgmt_updated_at' => ' ',
            'tauthor_id' => ' ',
            'third_fu' => ' ',
            'tfu_mgmtaction' => ' ',
            'tfu_status' => ' ',
            'tfu_updated_at' => ' ',
            'tfumgmt_updated_at' => ' ',
        ]);

        return response()->json($afrecommendation);

        // return 'success';

        // $sample = $request['_ids'];

        // print_r($request->all());
        
    }

    public function update(Request $request, $id){
        $afrecommendation = afrecommendation::where('id', $id)
                  ->update([
                    'afrecommend' => $request['findings_recommendation']
                    ]);

        $dataArray = array('recommendation'=> $request['findings_recommendation']);
                
        return response()->json($dataArray);
        
    }

    public function delete(Request $request, $id){
        $afrecommendation = afrecommendation::where('id', $id)->delete();

        $dataArray = array('recommendation'=> $request['findings_recommendation']);
                
        return "success";
        
    }
}
