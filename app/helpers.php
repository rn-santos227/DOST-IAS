<?php
use App\User;
use App\agency;
use App\form_001_audit_report;
use App\formcontent;
use App\auditors;
use App\iasstaff;
use App\managementAction;
use App\afrecommendation;
use App\fileupload;


// for review results ca
function test_status_color($status)
{
	if ($status == '1') 
	{
		$color = 'label-success';
	}
	else if ($status == '2') 
	{
		$color = 'label-danger';
	}
	else if ($status == '3') 
	{
		$color = 'label-warning';
	}
	else if ($status == '4') 
	{
		$color = 'label-success';
	}
	else if ($status == '5') 
	{
		$color = 'label-danger';
	}
	else if ($status == '6') 
	{
		$color = 'label-primary';
	}
	else if ($status == '7') 
	{
		$color = 'label-warning';
	}
	else{
		$color = 'label-default';
	}

	return $color;
}

function check_status_print($id, $valInt){
	$val = form_001_audit_report::findOrFail($id);

	if ($val->for_management_action == 'i') {
		if ($valInt == 1) {
			return '';
		}else{
			return 'none';
		}
	}else if ($val->for_management_action == 1) {
		if ($valInt == 1) {
			return '';
		}else{
			return 'none';
		}
	}elseif ($val->for_management_action == 2) {
		if ($valInt == 1 || $valInt == 2) {
			return '';
		}else{
			return 'none';
		}
	}elseif ($val->for_management_action == 3) {
		if ($valInt == 1 || $valInt == 2 || $valInt == 3) {
			return '';
		}else{
			return 'none';
		}
	}elseif ($val->for_management_action == 'f') {	
		if ($valInt == 1 || $valInt == 2 || $valInt == 3 || $valInt == 'f') {
			return '';
		}else{
			return 'none';
		}
	}
}
////////
function count_openstat($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'OPEN')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'OPEN')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'OPEN')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'OPEN')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'OPEN')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'OPEN')->count();
	}

	return $val;
}
function count_paraddstat($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'OPEN but partially addressed')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'OPEN but partially addressed')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'OPEN but partially addressed')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'OPEN but partially addressed')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'OPEN but partially addressed')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'OPEN but partially addressed')->count();
	}

	return $val;
}
function count_closedstat($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'CLOSED')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'CLOSED')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'CLOSED')->count();
		$val = $vals+$stat;
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'CLOSED')->count();
		$val = $vals+$stat;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status', 'CLOSED')->count();
		$vals1 = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'CLOSED')->count();
		$val = $vals+$vals1+$stat;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('sfu_status', 'CLOSED')->count();
	}

	return $val;
}


////////
function count_monitored_mgmtaction($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('third_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function count_answered_ffu($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status', 'like', '%OPEN%')->where('ffu_mgmtaction', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('third_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function check_answered_ffu_count($f00Id){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function check_fu_mgmtaction($f00Id){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','like','%OPEN%')->where('ffu_mgmtaction', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status','like','%OPEN%')->where('sfu_mgmtaction', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function count_allopen($f00Id){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','OPEN')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','OPEN')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status','OPEN')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status','OPEN')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status','OPEN')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status','OPEN')->count();
	}

	return $val;
}

function count_allparadd($f00Id){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','Open but partially addressed')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','Open but partially addressed')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status','Open but partially addressed')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status','Open but partially addressed')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status','Open but partially addressed')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status','Open but partially addressed')->count();
	}

	return $val;
}

function count_allclosed($f00Id){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','CLOSED')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('status','CLOSED')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status', 'CLOSED')->count();
		$val = $vals+$stat;
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status', 'CLOSED')->count();
		$vals2 = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status', 'CLOSED')->count();
		$val = $vals+$vals2+$stat;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$stat = afrecommendation::where('form_001_id', $f00Id)->where('status', 'CLOSED')->count();
		$vals = afrecommendation::where('form_001_id', $f00Id)->where('ffu_status', 'CLOSED')->count();
		$vals1 = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status', 'CLOSED')->count();
		$val = $vals+$vals1+$stat;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('sfu_status','CLOSED')->count();
	}

	return $val;
}
///////
function check_answered_recommendation_count($f00Id, $afId){
	$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('management_action', '!=', '')->count();
	return $val;
}
function count_allrecommendationanswer($f00Id){
	$val = afrecommendation::where('form_001_id', $f00Id)->where('management_action', '!=', '')->count();
	return $val;
}
function count_allrecommendation($f00Id){
	$val = afrecommendation::where('form_001_id', $f00Id)->count();
	return $val;
}

function count_recommendation($f00Id, $afId){
	$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->count();
	return $val;
}

function count_recommendations($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);
	

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status','like','%OPEN%')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('ffu_status','like','%OPEN%')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function count_all_ffu($f00Id, $afId){
	$f1 = form_001_audit_report::findOrFail($f00Id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$val = '0';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('first_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {

		$val = afrecommendation::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->where('status','like','%OPEN%')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('second_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$val = afrecommendation::where('form_001_id', $f00Id)->where('third_fu', '!=', '')->count();
	}

	return $val;
}

function count_docs($f00Id, $afId){
	$val = fileupload::where('form_001_id', $f00Id)->where('auditfinding_no', $afId)->count();
	return $val;
}

function check_status_sendreporttoias($id){
// check the status if ready to send addressed report findings to IAS.
// view_audit_findings.blade.php
// auditee

	$f1 = form_001_audit_report::findOrFail($id);
	$count_items = formcontent::where('form_001_id', $id)->count();
	$count_istatus_items = managementAction::where('form_001_id', $id)->where('istatus', '=', 'OPEN')->count();
	$count_fmanagement_action_items = managementAction::where('form_001_id', $id)->where('fmanagement_action', '!=', '')->count();
	$count_smanagement_action_items = managementAction::where('form_001_id', $id)->where('smanagement_action', '!=', '')->count();
	$count_tmanagement_action_items = managementAction::where('form_001_id', $id)->where('tmanagement_action', '!=', '')->count();
	$count_recommendations = afrecommendation::where('form_001_id', $id)->count();
	$count_mgmtaction = afrecommendation::where('form_001_id', $id)->where('management_action', '!=', '')->count();
	$count_final_status = managementAction::where('form_001_id', $id)->where('final_status', '=', 'OPEN')->count();

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		if ($count_recommendations != $count_mgmtaction) {
			$result = 'disabled';
		}else {
			$result = '';
		}
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		if ($count_istatus_items != $count_fmanagement_action_items) {
			$result = 'disabled';
		}else {
			$result = '';
		}
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		if ($count_final_status != $count_smanagement_action_items) {
			$result = 'disabled';
		}else {
			$result = '';
		}
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		if ($count_final_status != $count_tmanagement_action_items) {
			$result = 'disabled';
		}else {
			$result = '';
		}
	}elseif ($f1->for_management_action == 'f' && $f1->receiver == 2) {
		$result = 'disabled';
	}

	return $result;
}

function check_cusrsor_print($id, $cursorInt){
	$val = form_001_audit_report::findOrFail($id);

	if ($val->for_management_action == 1) {
		if ($cursorInt == 1) {
			return ' ';
		}else{
			return 'not-allowed';
		}
	}elseif ($val->for_management_action == 2) {
		if ($cursorInt == 1 || $cursorInt == 2) {
			return ' ';
		}else{
			return 'not-allowed';
		}
	}elseif ($val->for_management_action == 3) {
		if ($cursorInt == 1 || $cursorInt == 2 || $cursorInt == 3) {
			return ' ';
		}else{
			return 'not-allowed';
		}
	}elseif ($val->for_management_action == 'f') {
		if ($cursorInt == 1 || $cursorInt == 2 || $cursorInt == 3 || $cursorInt == 'f') {
			return ' ';
		}else{
			return 'not-allowed';
		}
	}
}

function count_item_revision($id){
	$count = formcontent::where('form_001_id', $id)->where('status', 1)->count();
	return $count;
}

function count_item_approved($id){
	$count = formcontent::where('form_001_id', $id)->where('status', 2)->count();
	return $count;
}


function agency_name($id)
{
	$a_name = agency::findOrFail($id);
	return $a_name->name;
}

function upperagency_name($id)
{
	$a_name = agency::findOrFail($id);
	return strtoupper($a_name->name);
}

function auditor($id)
{
	$a_name = auditors::where('user_id', $id)->first();
	return $a_name->title . $a_name->name . ' – ' . $a_name->agency;
}

function agency_acro($name){
	$a_acro = agency::where('name', $name)->first();
	return $a_acro['code'];
}

function auditor_leader($id)
{
	$a_name = auditors::where('user_id', $id)->first();
	return $a_name->title. ' ' .$a_name->name . ' - ' . $a_name->position . ', ' . $a_name->agency;
}

function auditor_contact_no($id)
{
	$a_contact = User::where('id', $id)->first();

	return $a_contact->contact;	
}



function agency_codebyname($name)
{
	$a_code = agency::where('name', 'LIKE', $name)->first();
	if (!$a_code) {
		# code...
	} else {
		return $a_code->code;
	}
	
	
}


function auditor_detail($id)
{
	$a_name = auditors::where('user_id', $id)->first();
	return $a_name->title. ' ' .$a_name->name . ' - ' . $a_name->position . ', ' . agency_codebyname($a_name->agency). '<br/>';
}

function auditor_members_report($id)
{
	$a_name = form_001_audit_report::findOrFail($id);
	$arr_amem = explode(',', $a_name->amember_id); 
	$vals = '';

	foreach ($arr_amem as $val) {
		$vals .= auditor_detail($val);
	}

	return $vals;
	
}

function secretariat_detail($id)
{
	$a_name = iasstaff::where('user_id', $id)->first();
	return $a_name->name . ' - ' . $a_name->position . ', ' . 'IAS'. '<br/>';
}

function secretariats($id)
{
	$a_name = form_001_audit_report::findOrFail($id);
	$arr_amem = explode(',', $a_name->secretariat_id); 
	$vals = '';

	foreach ($arr_amem as $val) {
		$vals .= secretariat_detail($val);
	}

	return $vals;
	
}

function auditees($id)
{
	$a_name = form_001_audit_report::findOrFail($id);
	// $arr_amem = explode(';', $a_name->auditees); 
	// $vals = '';

	// foreach ($arr_amem as $val) {
	// 	$vals .= $val."<br/>";
	// }

	return $a_name->auditees;
	
}


function auditor_member($id)
{
	$a_name = auditors::where('user_id', $id)->first();
	return '<b>'.$a_name->title. ' ' .$a_name->name . '</b><br>Audit Team Member</br>' . $a_name->position . ', ' . agency_acro($a_name->agency) . '<br></br>';
}

function secretariat($id)
{
	$a_name = iasstaff::where('user_id', $id)->first();
	return '<b>'.$a_name->title. ' ' .$a_name->name . '</b><br>' . $a_name->position . ', IAS<br><br>';

	// return $id;
}

function author($id)
{
	$user = User::findOrFail($id);
	return $user->name;
}


function agency_code($id)
{
	$a_code = agency::findOrFail($id);
	return $a_code->code;
}



function agency_email($id)
{
	$a_code = agency::findOrFail($id);
	return $a_code->emailhead;
}

function scope_audit($id)
{
	$val = form_001_audit_report::findOrFail($id);
	return $val->scope_audit;
}

function clean($string) {
   $string = str_replace(' ', " ", $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9&\-\(\) ]/', ' ', $string); // Removes special chars.
}

function check_answer($form_id, $finding_id){

	$stage = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();



	if ($stage->monitoring_stage == 'i') {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if (count($val->imanagement_action) == 0) {
			$result = 'update answer';
		}else {
			$result = 'answer';
		}
	}elseif ($stage->monitoring_stage == 1) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->istatus == 'CLOSED') {
			$result = 'view';
		}
		elseif ($val->fmanagement_action == '') {
			$result = 'answer 1st follow-up';
		}else {
			$result = 'update answer';
		}
	}elseif ($stage->monitoring_stage == 2) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->fstatus == 'CLOSED') {
			$result = 'view';
		}
		elseif ($val->smanagement_action == '') {
			$result = 'answer 2nd follow-up';
		}else {
			$result = 'update answer';
		}
	}elseif ($stage->monitoring_stage == 3) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->sstatus == 'CLOSED') {
			$result = 'view';
		}elseif ($val->tmanagement_action == '') {
			$result = 'answer 3rd follow-up';
		}else {
			$result = 'update answer';
		}
	}

	return $result;
}

function check_answer_status($form_id, $finding_id){

	$stage = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();



	if ($stage->monitoring_stage == 'i') {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if (count($val->imanagement_action) == 0) {
			$result = 'update answer';
		}else {
			$result = 'answer';
		}
	}elseif ($stage->monitoring_stage == 1) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->istatus == 'CLOSED') {
			$result = 'btn-success btn-sm';
		}else if ($val->fmanagement_action != '') {
			$result = 'btn-info btn-sm';
		}else {
			$result = 'btn-danger';
		}
	}elseif ($stage->monitoring_stage == 2) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->fstatus == 'CLOSED') {
			$result = 'btn-success';
		}else {
			$result = 'btn-trans';
		}
	}elseif ($stage->monitoring_stage == 3) {
		$val = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		if ($val->sstatus == 'CLOSED') {
			$result = 'btn-success';
		}else {
			$result = 'btn-trans';
		}
	}

	return $result;
}

function check_status_if_fma($id){

	$val = form_001_audit_report::findOrFail($id);

	if ($val->for_management_action == 0) {
		$result = '';
	}else {
		$result = 'disabled';
	}

	return $result;
}

function check_status_if_fma_mng($id){

	$val = form_001_audit_report::findOrFail($id);

	if ($val->for_management_action != '') {
		$result = '';
	}else {
		$result = 'disabled';
	}

	return $result;
}

function check_status_if_fma_2($id){

	$val = form_001_audit_report::findOrFail($id);

	return $val->for_management_action;
}

function check_monitoring_stage_i($id, $stage){
	$val = form_001_audit_report::findOrFail($id);

	if ($val->for_management_action == $stage) {
		$result = 'none';
	}else{
		$result = 'inline-block';
	}
	
	return $result;
}


function checkifmonitored($form_id, $finding_id){

	// $f1 = form_001_audit_report::findOrFail($form_id);

	// if ($f1->for_management_action == 'i') {
 //   //      $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

 //   //      if($mgtaction->imonitoring_mgtaction != ''){
	// 		// $result = 'update monitoring status';
 //   //      }else{
 //   //      	$result = 'monitor management action';
 //   //      }

	// 	$result = '';
 //    }elseif ($f1->for_management_action == 1) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

 //        if($mgtaction->imonitoring_mgtaction != ''){
	// 		$result = 'update monitoring status';
 //        }else{
 //        	$result = 'monitor management action';
 //        }
 //    }elseif ($f1->for_management_action == 2) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->fmonitoring_mgtaction != ''){
	// 		$result = 'update monitoring status';
 //        }elseif ($mgtaction->istatus == "CLOSED") {
 //        	$result = 'view closed finding';
 //        }
 //        else{
 //        	$result = 'monitor management action';
 //        }
 //    }elseif ($f1->for_management_action == 3) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->smonitoring_mgtaction != ''){
	// 		$result = 'update monitoring status';
 //        }elseif ($mgtaction->istatus == "CLOSED" || $mgtaction->fstatus == "CLOSED" ) {
 //        	$result = 'view closed finding';
 //        }
 //        else{
 //        	$result = 'monitor management action';
 //        }
 //    }else{
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->tmonitoring_mgtaction != ''){
	// 		$result = 'update monitoring status';
 //        }elseif ($mgtaction->istatus == "CLOSED" || $mgtaction->fstatus == "CLOSED" || $mgtaction->sstatus == "CLOSED") {
 //        	$result = 'view closed finding';
 //        }else{
 //        	$result = 'monitor management action';
 //        }
 //    }

 //    return $result;

}

function checkifmonitoredbuttoncolor($form_id, $finding_id){

	// $f1 = form_001_audit_report::findOrFail($form_id);

	// if ($f1->for_management_action == 'i') {
 //   //      $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

 //   //      if($mgtaction->imonitoring_mgtaction != ''){
	// 		// $result = 'update monitoring status';
 //   //      }else{
 //   //      	$result = 'monitor management action';
 //   //      }

	// 	$result = '';
 //    }elseif ($f1->for_management_action == 1) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

 //        if($mgtaction->imonitoring_mgtaction != ''){
	// 		$result = 'btn-warning';
 //        }else{
 //        	$result = 'btn-info';
 //        }
 //    }elseif ($f1->for_management_action == 2) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->fmonitoring_mgtaction != ''){
	// 		$result = 'btn-warning';
 //        }elseif ($mgtaction->istatus == "CLOSED") {
 //        	$result = 'btn-success';
 //        }
 //        else{
 //        	$result = 'btn-info';
 //        }
 //    }elseif ($f1->for_management_action == 3) {
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->smonitoring_mgtaction != ''){
	// 		$result = 'btn-warning';
 //        }elseif ($mgtaction->istatus == "CLOSED" || $mgtaction->fstatus == "CLOSED" ) {
 //        	$result = 'btn-success';
 //        }
 //        else{
 //        	$result = 'btn-info';
 //        }
 //    }else{
 //        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
 //        if($mgtaction->tmonitoring_mgtaction != ''){
	// 		$result = 'btn-warning';
 //        }elseif ($mgtaction->istatus == "CLOSED" || $mgtaction->fstatus == "CLOSED" || $mgtaction->sstatus == "CLOSED") {
 //        	$result = 'btn-success';
 //        }else{
 //        	$result = 'btn-info';
 //        }
 //    }

 //    return $result;

}

function check_open_close_status($form_id, $finding_id){

	$f1 = form_001_audit_report::findOrFail($form_id);

	if ($f1->for_management_action == 1) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
		$result = $mgtaction->istatus;
    }elseif ($f1->for_management_action == 2) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
        $result = $mgtaction->fstatus;
    }elseif ($f1->for_management_action == 3) {
        $result = $mgtaction->sstatus;
    }else{
        $result = $mgtaction->tstatus;
    }

    return $result;

}

function check_open_close_statusupdate($form_id, $finding_id, $fma_stage){

	$f1 = form_001_audit_report::findOrFail($form_id);

	if ($f1->for_management_action == $fma_stage) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
		$result = $mgtaction->final_status;
    }else{
    	if ($fma_stage == 1) {
	        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
			if ($mgtaction->fstatus == '') {
	        	$result = $mgtaction->istatus;
	        }else{
	        	$result = $mgtaction->fstatus;
	        }
	        
	    }elseif ($fma_stage == 2) {
	        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
	        $result = $mgtaction->fstatus;
	    }elseif ($fma_stage == 3) {
	        $result = $mgtaction->sstatus;
	    }else{
	        $result = $mgtaction->tstatus;
	    }
    }

    return $result;

}	

function check_total_closed_status($report_id, $monitoring_stage){
	if ($monitoring_stage == 'i') {
		$result = managementAction::where('form_001_id', $report_id)->where('istatus', 'LIKE', '%CLOSED%' )->count();
	}elseif ($monitoring_stage == 1) {
		$result = managementAction::where('form_001_id', $report_id)->where('fstatus', 'LIKE', '%CLOSED%' )->count();
	}elseif ($monitoring_stage == 2) {
		$result = managementAction::where('form_001_id', $report_id)->where('sstatus', 'LIKE', '%CLOSED%' )->count();
	}elseif ($monitoring_stage == 3) {
		$result = managementAction::where('form_001_id', $report_id)->where('tstatus', 'LIKE', '%CLOSED%' )->count();
	}

	return $result;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkifaddressed($form_id, $finding_id){
// auditee address management action - update button label if for address or for update
// view_audit_findings.blade.php
	$f1 = form_001_audit_report::findOrFail($form_id);

	if ($f1->for_management_action == 'i') {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

        if($mgtaction['imanagement_action'] != ''){
			$result = 'update answer';
        }else{
        	$result = 'answer management action';
        }
    }elseif ($f1->for_management_action == 1) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
        if (stripos($mgtaction['istatus'], 'CLOSED') !== FALSE) {
        	$result = 'view closed item';
        }else{
        	if($mgtaction['fmanagement_action'] != ''){
				$result = 'update answer';
	        }else{
	        	$result = 'answer 1st follow-up';
	        }
        }
	        
    }elseif ($f1->for_management_action == 2) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
        if (stripos($mgtaction['final_status'], 'CLOSED') !== FALSE) {
        	$result = 'view closed item';
        }else{
        	if($mgtaction['smanagement_action'] != ''){
				$result = 'update answer';
	        }else{
	        	$result = 'answer 2nd follow-up';
	        }
        }
    }elseif ($f1->for_management_action == 3) {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
       
        if (stripos($mgtaction['final_status'], 'CLOSED') !== FALSE) {
        	$result = 'view closed item';
        }else{
        	if($mgtaction['tmanagement_action'] != ''){
				$result = 'update answer';
	        }else{
	        	$result = 'answer 3rd follow-up';
	        }
        }
    }elseif ($f1->for_management_action == 'f') {
        $mgtaction = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
       
        if (stripos($mgtaction['final_status'], 'CLOSED') !== FALSE) {
        	$result = 'view closed item';
        }else{
	        	$result = "auditor's final monitoring";
        }
    }

    return $result;

}

function count_item_mgtaction($id){
// auditee
// for check_status_sendreporttoias
	$f1 = form_001_audit_report::findOrFail($id);

	if ($f1->for_management_action == 'i') {
        $count = formcontent::where('form_001_id', $id)->where('auditmanageaction', '=', 'i')->count();
		return $count;
    }elseif ($f1->for_management_action == 1) {
      	$count = formcontent::where('form_001_id', $id)->where('auditmanageaction', '=', 1)->count();
		return $count;
    }elseif ($f1->for_management_action == 2) {
       	$count = formcontent::where('form_001_id', $id)->where('auditmanageaction', '=', 2)->count();
		return $count;
    }elseif ($f1->for_management_action == 3) {
        $count = formcontent::where('form_001_id', $id)->where('auditmanageaction', '=', 3)->count();
		return $count;
    }

    return $count;
}

function count_item($id, $monitoring_stage){
// auditee
// for check_status_sendreporttoias
	

	$f1 = form_001_audit_report::findOrFail($id);

	if ($monitoring_stage == 'i') {
        $count = formcontent::where('form_001_id', $id)->count();
		return $count;
    }elseif ($monitoring_stage == 1) {
      	$count = managementAction::where('form_001_id', $id)->where('istatus', '==', 'OPEN')->count();
		return $count;
    }elseif ($monitoring_stage == 2) {
       	$count = managementAction::where('form_001_id', $id)->where('fstatus', '==', 'OPEN')->count();
		return $count;
    }elseif ($monitoring_stage == 3) {
        $count = managementAction::where('form_001_id', $id)->where('sstatus', '==', 'OPEN')->count();
		return $count;
    }elseif ($monitoring_stage == 'f') {
        $count = managementAction::where('form_001_id', $id)->where('tstatus', '==', 'OPEN')->count();
		return $count;
    }elseif ($monitoring_stage == 'd') {
        $count = formcontent::where('form_001_id', $id)->count();
		return $count;
    }
}

function count_audit_finding_no($id){
// auditee
// for check_status_sendreporttoias
	$data = formcontent::find($id);

	if ($data == null) {
		
	} else {
		$count = formcontent::where('form_001_id', $id)->count();
		return $count + 1;
	}
	
      	
}

function check_receiver($id){
// check if the receiver is the encode/auditor/iasstaff (receiver => 2) or the auditee (receiver => 1) 
// monitoring_home.blade.php
// view_audit_findings.blade.php

	$val = form_001_audit_report::findOrFail($id);
	
	return $val->receiver;
}

function check_fmastage_manage_button($id, $monitoring_stage){
// fmastage = for management action stage 
// check the current management action stage; 
// enable/disable buttons for managing management action and follow-up
// monitoring_home.blade.php

	$f1 = form_001_audit_report::findOrFail($id);

	if ($f1->for_management_action == $monitoring_stage) {
 
		$result = ' ';

    }else{

    	$result = 'disabled';
    }

	return $result;
}

function check_monitoring_stage($id, $fma, $receiver, $monitoring_stage){
// check if what stage the auditor will monitor follow-up
// view_monitoring_items
// view_audit_findings_blade
	$result = form_001_audit_report::findOrFail($id);
	
	if ($result->for_management_action == $fma && $result->receiver == $receiver && $monitoring_stage == 'i') {
		$results = 'inline-block';
	}elseif ($result->for_management_action == $fma && $result->receiver == $receiver && $monitoring_stage == 1) {
		$results = 'inline-block';
	}elseif ($result->for_management_action == $fma && $result->receiver == $receiver && $monitoring_stage == 2) {
		$results = 'inline-block';
	}elseif ($monitoring_stage == 'default') {
		if ($result->for_management_action == $fma && $result->receiver == $receiver && $monitoring_stage == 'default') {
			$results = 'none'; 
		}else {
			$results = 'inline-block';
		}
	}else{
		$results = 'none';
	}

	return $results;
	
}

function view_done_monitoring_stage($id, $monitoring_stage){
// view done monitoring stage
// view_audit_findings_blade
	$result = form_001_audit_report::findOrFail($id);
	
	if ($result->for_management_action == 1) {
		if ($monitoring_stage ==	 'donei') {
			$results = 'none';
		}		
	}elseif ($result->for_management_action == 2) {
		if ($monitoring_stage == 'donei') {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}elseif ($result->for_management_action == 3) {
		if ($monitoring_stage == 'donei' || $monitoring_stage == 'done1') {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}

	return $results;
	
}


function addressManagementActionModal($form_id, $finding_id){
	$stage = formcontent::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();
	$f1 = form_001_audit_report::findOrFail($form_id);

	if ($f1->for_management_action == 'i') {
		$result = 'viewContentModal';
	}else{
		$result = 'viewFirstFollowUPModal';
	}

	return $result;
}

function check_total_open_status($report_id, $monitoring_stage){
	
// check the total open items 
// monitoring_home.blade.php
	
	$f1 = form_001_audit_report::findOrFail($report_id);

	if ($f1->for_management_action == $monitoring_stage) {
        $result = managementAction::where('form_001_id', $report_id)->where('final_status', 'LIKE', '%OPEN%' )->count();
    }else{
    	if ($monitoring_stage == 'i') {
    		$result = managementAction::where('form_001_id', $report_id)->where('istatus', 'LIKE', '%OPEN%' )->count();	
    	}elseif ($monitoring_stage == 1) {
			$result = managementAction::where('form_001_id', $report_id)->where('fstatus', 'LIKE', '%OPEN%' )->count();
		}elseif ($monitoring_stage == 2) {
			$result = managementAction::where('form_001_id', $report_id)->where('sstatus', 'LIKE', '%OPEN%' )->count();
		}elseif ($monitoring_stage == 3) {
			$result = managementAction::where('form_001_id', $report_id)->where('tstatus', 'LIKE', '%OPEN%' )->count();
		}
    }

	return $result;
}

function count_findings_addressed($id, $monitoring_stage){
// count findings that has been already addressed by the auditee per monitoring page
// monitoring_home

	$f1 = form_001_audit_report::findOrFail($id);

	if ($monitoring_stage == 'i') {
		$result = managementAction::where('form_001_id', $id)->where('imanagement_action', '!=', '' )->count();	
	}elseif ($monitoring_stage == 1) {
		$result = managementAction::where('form_001_id', $id)->where('fmanagement_action', '!=', '' )->count();	
	}elseif ($monitoring_stage == 2) {
		$result = managementAction::where('form_001_id', $id)->where('smanagement_action', '!=', '' )->count();	
	}elseif ($monitoring_stage == 3) {
		$result = managementAction::where('form_001_id', $id)->where('tmanagement_action', '!=', '' )->count();	
	}

	return $result;
}

function check_stage($id){
// check the current stage of the monitong
// example: monitoring of corrective action, 1st follow-up
// monitoring_home

	$f1 = form_001_audit_report::findOrFail($id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$result = 0;
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		$result = 1;
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$result = 2;
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$result = 3;
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$result = 4;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$result = 5;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$result = 6;
	}elseif ($f1->for_management_action == 'f' && $f1->receiver == 2) {
		$result = 7;
	}

	return $result;
}

function count_all_openprevious($id){
// check the current stage of the monitong
// example: monitoring of corrective action, 1st follow-up
// monitoring_home

	$f1 = form_001_audit_report::findOrFail($id);

	if ($f1->for_management_action == 2 && $f1->receiver == 2) {
		$result = afrecommendation::where('form_001_id', $id)->where('status','like','%OPEN%')->count();
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$result = 4;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		$result = 5;
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$result = 6;
	}elseif ($f1->for_management_action == 'f' && $f1->receiver == 2) {
		$result = 7;
	}

	return $result;
}

function check_status_sendreporttoauditee($id){
// check the status if ready to send monitored management actions to auditees.
// view_monitoring_items.blade.php
// auditors/ias staff

	$f1 = form_001_audit_report::findOrFail($id);
	$count_items = formcontent::where('form_001_id', $id)->count();
	$count_imgtaction = managementAction::where('form_001_id', $id)->where('imanagement_action', '!=', '')->count();
	$count_immgtaction = managementAction::where('form_001_id', $id)->where('imonitoring_mgtaction', '!=', '')->count();
	$count_fmgtaction = managementAction::where('form_001_id', $id)->where('fmanagement_action', '!=', '')->count();
	$count_fmmgtaction = managementAction::where('form_001_id', $id)->where('fmonitoring_mgtaction', '!=', '')->count();
	$count_smgtaction = managementAction::where('form_001_id', $id)->where('smanagement_action', '!=', '')->count();
	$count_smmgtaction = managementAction::where('form_001_id', $id)->where('smonitoring_mgtaction', '!=', '')->count();
	$count_tmgtaction = managementAction::where('form_001_id', $id)->where('tmanagement_action', '!=', '')->count();
	$count_tmmgtaction = managementAction::where('form_001_id', $id)->where('tmonitoring_mgtaction', '!=', '')->count();

	if ($f1->for_management_action == 'i' && $f1->receiver == 1) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 2) {
		if ($count_imgtaction != $count_immgtaction) {
			$result = 'disabled';
		}else {
			$result = '';
		}		
	}elseif ($f1->for_management_action == 1 && $f1->receiver == 1) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 2) {
		if (check_answered_ffu_count($id) != count_all_openprevious($id)) {
			$result = 'disabled';
		}else {
			$result = '';
		}	
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		if ($count_smgtaction != $count_smmgtaction) {
			$result = 'disabled';
		}else {
			$result = '';
		}	
	}elseif ($f1->for_management_action == 2 && $f1->receiver == 1) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 2) {
		if ($count_tmgtaction != $count_tmmgtaction) {
			$result = 'disabled';
		}else {
			$result = '';
		}	
	}elseif ($f1->for_management_action == 3 && $f1->receiver == 1) {
		$result = 'disabled';
	}elseif ($f1->for_management_action == 'f' && $f1->receiver == 2) {
		if ($count_tmgtaction != $count_tmmgtaction) {
			$result = 'disabled';
		}else {
			$result = '';
		}	
	}

	return $result;
}


function check_button_stage($id){
// view_monitoring_items
	$result = form_001_audit_report::findOrFail($id);
	
	if ($result->for_management_action == 'i') {
		if ($result->receiver != 1) {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}elseif ($result->for_management_action == 1) {
		if ($result->receiver == 1) {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}elseif ($result->for_management_action == 2) {
		if ($result->receiver == 1) {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}elseif ($result->for_management_action == 3) {
		if ($monitoring_stage == 'donei' || $monitoring_stage == 'done1') {
			$results = 'inline-block';
		}else{
			$results = 'none';
		}
	}

	return $results;
	
}

function check_ma_status($form_id, $finding_id){
// Check the auditee's management action status (open or closed)
// view_audit_findings_blade

	$f1 = form_001_audit_report::findOrFail($form_id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1 ) {
		$result = "";
	}else{
		$ma = managementAction::where('form_001_id', $form_id)->where('auditfinding_no', $finding_id)->first();

		$result = $ma['final_status'];
	}
	return $result;
}

function check_ma_status_span_display($id){
// Check the auditee's management action status (open or closed)
// view_audit_findings_blade

	$f1 = form_001_audit_report::findOrFail($id);

	if ($f1->for_management_action == 'i' && $f1->receiver == 1 || $f1->for_management_action == 1 && $f1->receiver == 2) {
		$result = "none";
	}else{
		$result = "inline-block";
	}

	return $result;
}

function check_if_closing($id){
// view_monitoring_items
	$result = form_001_audit_report::findOrFail($id);
	
	if ($result->for_management_action == 'f') {
			$results = 'none';
	}else{
		$results = 'inline-block';
	}

	return $results;
	
}