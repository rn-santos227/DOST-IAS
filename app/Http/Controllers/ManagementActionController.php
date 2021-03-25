<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\form_001_audit_report;
use App\formcontent;
use App\fileUpload;
use App\comments;
use App\Auditees;
use App\managementAction;
use App\afrecommendation;
use View;
use Auth;
use PDF;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class ManagementActionController extends Controller
{
    public function index($id){
        $form001s = form_001_audit_report::where('id', $id)->orderBy('created_at', 'desc')->get();
        $scopes = form_001_audit_report::where('id', $id)->pluck('scope_audit');
        $a_findings = formcontent::where('form_001_id', $id)->orderBy('id', 'asc')->get();

        // Session::flash('error_msg', 'Please fill up all the fields!');
        // Session::flash('success_msg', 'Audit Finding and Recommendations has been created!');

        return View::make('auditee.view_audit_findings')
        ->with('form001s', $form001s)
        ->with('scopes', $scopes)
        ->with('a_findings', $a_findings)
        ->with(compact('id', $id));
    }
    public function submit_mgtaction(Request $request, $id){

        $f1 = form_001_audit_report::findOrFail($request['f001_id']);

        if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
            $sbmt_mgtaction = afrecommendation::where('id', $id)->update(['management_action' => $request['mgtactions']]);
        }elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
            $sbmt_mgtaction = afrecommendation::where('id', $id)->update(['ffu_mgmtaction' => $request['mgtactions'], 'ffumgmt_updated_at' => Carbon::now()]);
        }elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
            $sbmt_mgtaction = afrecommendation::where('id', $id)->update(['sfu_mgmtaction' => $request['mgtactions'], 'sfumgmt_updated_at' => Carbon::now()]);
        }

        return 'success';

        // print_r($request->all());
    }

    public function submit_ffu(Request $request, $id){
        $af_id = $request['af_id'];
        $submit_ffu_result = afrecommendation::where('id', $id)->update([
            'status' => $request['fstatuss'],
            'fauthor_id' => Auth::user()->id,
            'first_fu' => $request['ffus'],
            'ffu_updated_at' => Carbon::now()
        ]);

        return 'success';
    }

    public function submit_sfu(Request $request, $id){
        $af_id = $request['af_id'];
        $submit_ffu_result = afrecommendation::where('id', $id)->update([
            'ffu_status' => $request['fstatuss'],
            'sauthor_id' => Auth::user()->id,
            'second_fu' => $request['ffus'],
            'sfu_updated_at' => Carbon::now()
        ]);

        return 'success';
    }

    public function submit_tfu(Request $request, $id){
        $af_id = $request['af_id'];
        $submit_ffu_result = afrecommendation::where('id', $id)->update([
            'sfu_status' => $request['fstatuss'],
            'tauthor_id' => Auth::user()->id,
            'third_fu' => $request['ffus'],
            'tfu_updated_at' => Carbon::now()
        ]);

        return 'success';
    }

    public function answer_af(Request $request)
    {

        $f_id = $request->f_id;
        $id_c = $request->id_c;
        $mgtdate = '';
        $mcadate = '';
        $action = '';
        $status = '';
        $mgt_actions = '';
        $mgt_action_date = '';
        $finding = formcontent::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
        $mgt_action = managementAction::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
        $recommendations = afrecommendation::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
        

        $f1 = form_001_audit_report::findOrFail($f_id);

        if ($f1->for_management_action == 'i') {
            $finding = formcontent::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
        }elseif ($f1->for_management_action == 1) {
            $mgt_actions = afrecommendation::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
            // $action = $mgt_actions->managementAction;
            // $status = $mgt_actions->istatus;
            $status = 'sasa';
        }elseif ($f1->for_management_action == 2) {
            $mgt_action_date = managementAction::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->first();
        }elseif ($f1->for_management_action == 3) {
            $mgt_action_date = managementAction::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->first();
        }elseif ($f1->for_management_action == 'f') {
            $mgt_action_date = managementAction::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->first();
        }
        return response()->json($arrayName = array('f1' => $f1, 'action' => $action, 'status' => $status, 'finding' => $finding, 'recommendations' => $recommendations, 'mgt_action' => $mgt_action, 'mgt_action_date' => $mgt_action_date, 'mgt_actions' => $mgt_actions));
    }

    public function submit_mgtaction_edit(Request $request, $id){
        $f_id = $request['f001_id'];
        $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
            'imanagement_action' => $request['m_action']
        ]);

         return 'success';
    }

    public function send_ias_mgtaction($id){
        $f1 = form_001_audit_report::findOrFail($id);

        if ($f1->for_management_action == 'i') {
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'for_management_action' => 1,
                'receiver' => 2
            ]);
        }elseif ($f1->for_management_action == 1) {
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'for_management_action' => 2,
                'receiver' => 2
            ]);
        }elseif ($f1->for_management_action == 2) {
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'for_management_action' => 3,
                'receiver' => 2
            ]);
        }elseif($f1->for_management_action == 3){
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'for_management_action' => 'f',
                'receiver' => 2
            ]);
        }
    }

    public function submit_monitrong_status(Request $request, $id){
        $f_id = $request['f001_id'];
        $f1 = form_001_audit_report::findOrFail($f_id);

        if ($f1->for_management_action == 1) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'immgtaction_date' => Carbon::now(),
                'imonitoring_mgtaction' => $request['follow-up'],
                'istatus' => $request['follow-up-status'],
                'final_status' => $request['follow-up-status']
            ]);
            $status = $request['follow-up-status'];
        }elseif ($f1->for_management_action == 2) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'fmmgtaction_date' => Carbon::now(),
                'fmonitoring_mgtaction' => $request['monitor_1st_followup'],
                'fstatus' => $request['1st-followup-status'],
                'final_status' => $request['1st-followup-status']
            ]);

            $status = $request['1st-followup-status'];
        }elseif ($f1->for_management_action == 3) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'smmgtaction_date' => Carbon::now(),
                'smonitoring_mgtaction' => $request['monitor_2nd_followup'],
                'sstatus' => $request['2nd-followup-status'],
                'final_status' => $request['2nd-followup-status']
            ]);

            $status = $request['2nd-followup-status'];
        }elseif ($f1->for_management_action == 'f'){
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'tmmgtaction_date' => Carbon::now(),
                'tmonitoring_mgtaction' => $request['monitor_3rd_followup'],
                'tstatus' => $request['3rd-followup-status'],
                'final_status' => $request['3rd-followup-status']
            ]);

             $status = $request['3rd-followup-status'];
        }
        
        return $status;

    }

    public function send_auditee_monitoring($id){

        $f1 = form_001_audit_report::findOrFail($id);

        if ($f1->for_management_action == 1) {
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'receiver' => 1
            ]);
        }elseif ($f1->for_management_action == 2) {
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'receiver' => 1
            ]);
        }elseif($f1->for_management_action == 3){
            $send_mgtaction = form_001_audit_report::where('id', $id)->update([
                'receiver' => 1
            ]);
        }
    }

    public function submit_mgtaction1(Request $request, $id){
        $f_id = $request['f001_id1'];

        $f1 = form_001_audit_report::findOrFail($f_id);

        if ($f1->for_management_action == 1) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'fdate' => Carbon::now(),
                'fmanagement_action' => $request['mgt_actions_answer1']
            ]);
        }elseif ($f1->for_management_action == 2) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'sdate' => Carbon::now(),
                'smanagement_action' => $request['mgt_actions_answer2']
            ]);
        }elseif ($f1->for_management_action == 3) {
            $sbmt_mgtaction = managementAction::where('form_001_id', $f_id)->where('auditfinding_no', $id)->update([
                'tdate' => Carbon::now(),
                'tmanagement_action' => $request['mgt_actions_answer3']
            ]);
        }else{
        }
    }

}
