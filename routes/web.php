<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/auditreporthome', 'HomeController@auditreporthome');
Route::get('/encoder', 'EncoderController@index')->name('encoder');
Route::get('/ias_staff', 'IASController@index')->name('ias');
Route::get('/auditor', 'AuditorsController@index')->name('auditor');
Route::get('/agency', 'AgencyController@index')->name('agency');
Route::get('/director', 'DirectorController@index')->name('director');


//CREATE USER
Route::post('/store_encoder', 'EncoderController@store');
Route::post('/store_iasstaff', 'IASController@store');
Route::post('/store_auditors', 'AuditorsController@store');


// UPDATE USER DETAILS
Route::post('/encoder/{id}/update', 'EncoderController@update');
Route::post('/iasstaff/{id}/update', 'IASController@update');
Route::post('/auditors/{id}/update', 'AuditorsController@update');

// SEARCH
Route::get('/search/autocomplete', 'SearchController@autocomplete');

// CREATE FORM 001
Route::post('/store_form001', 'Form001Controller@store');

// VIEW FORM 001 CONTENT
Route::get('/form001_content/{id}', 'Form001Controller@index');
Route::post('/store_formcontent/{id}', 'Form001Controller@storecontent');
Route::post('/store_formsubcontent/{id}/{idafno}', 'Form001Controller@storesubcontent');

// ADD RECOMMENDATION
Route::post('/add_auditrecommendation/{id}', 'AfrecommendationController@store');

// UPDATE RECOMMENDATION
Route::post('/update/{id}', 'AfrecommendationController@update');

// DELETE RECOMMENDATION
Route::post('/delete/{id}', 'AfrecommendationController@delete');

// VIEW AUDIT FINDING
Route::get('/view_audit_finding', 'Form001Controller@view_af');

// UPDATE AUDIT FINDING
Route::post('/updatefinding/{id}', 'Form001Controller@updatefinding');

// UPDATE AUDIT FINDING DETAILS
Route::post('/update_findingdetails/{id}', 'Form001Controller@updatefindingdetails');

// // UPDATE AUDIT FINDING
// Route::post('/update_auditfinding/{id}', 'Form001Controller@update_af');

// ARCHIVE AUDIT FINDING
Route::post('/archive_audit_finding/{id}', 'Form001Controller@archive_af_true');
Route::post('/unarchive_audit_finding/{id}', 'Form001Controller@unarchive_af_true');

// VIEW UPDATE FORM 001
Route::get('/getview_update_form001/{id}', 'Form001Controller@getvu_form001');
// UPDATE
Route::post('/update_auditreport/{id}', 'Form001Controller@update_auditreport');


// PDF
Route::get('/downloadPDF/{id}','PDFController@form001PDFDownload');

Route::post('/upload', 'Form001Controller@upload');
Route::post('/add_rcomment/{id}', 'Form001Controller@add_rcomment');
Route::post('/add_fcomment/{id}', 'Form001Controller@add_fcomment');
Route::get('/get_support_doc/{id}', 'Form001Controller@get_support_doc');

Route::get('/getf_comment', 'Form001Controller@getf_comment');
Route::get('/getr_comment', 'Form001Controller@getr_comment');

Route::post('/approve_item/{id}', 'Form001Controller@approve_item');
Route::post('/approve_report/{id}', 'Form001Controller@approve_report');
Route::post('/cancel_approve_report/{id}', 'Form001Controller@cancel_approve_report');

Route::post('/send_to_auditee/{id}', 'Form001Controller@send_to_auditee');

// ///////////////////////////////// PRINT WORD REPORT //////////////////////////////////////////
Route::get('/download_audit_report/{id}','WordController@createWord');
Route::get('/download_followupaudit_report/{id}/{stage}','WordController@followUpReport');
Route::get('/download_summary_report/{id}/{stage}','WordController@summaryReport');

///////////////////////////////////////////////////////////////////// MONITORING REPORTS ///////////////////////////////////////////////////////////////////////////

Route::get('/monitoring-reports', function(){
	if (Auth::user()->role == 4) {
        $id = Auth::user()->id;
        $reports_monitoring = App\form_001_audit_report::whereRaw('find_in_set('.$id.', tleader_id)')->orwhereRaw('find_in_set('.$id.', amember_id)')->get();
		return View::make('monitoring.monitoring_home')->with('reports_monitoring', $reports_monitoring);
	} else {
		$reports_monitoring = App\form_001_audit_report::whereIn('for_management_action', ['i', 1, 2, 3, 'f'])->get();
		return View::make('monitoring.monitoring_home')->with('reports_monitoring', $reports_monitoring);
	}
});

Route::get('/monitoring-reports/{id}', 'MonitoringController@index');
Route::get('/monitoring-reports/{id}/first-followup', 'MonitoringController@first_followup');

///////////////////////////////////////////////////////////////////// MANAGEMENT ACTION ///////////////////////////////////////////////////////////////////////////
// VIEW AUDIT REPORT CONTENTS
Route::get('/findings/{id}', 'ManagementActionController@index');
// GET FINDING
Route::get('/answer_finding', 'ManagementActionController@answer_af');
// SUBMIT FIDNING MANAGEMENT ACTION
Route::post('/submit_mgtaction/{id}', 'ManagementActionController@submit_mgtaction');
// UPDATE MANAGEMENT ACTION
Route::post('/submit_mgtaction_edit/{id}', 'ManagementActionController@submit_mgtaction_edit');
// SEND IAS MANAGEMENT ACTION
Route::post('/send_ias_mgtaction/{id}', 'ManagementActionController@send_ias_mgtaction');
// SUBMIT/UPDATE MONITORING OF CA
Route::post('/submit_monitrong_status/{id}', 'ManagementActionController@submit_monitrong_status');
// SEND MONITORING TO AUDITEE
Route::post('/send_auditee_monitoring/{id}', 'ManagementActionController@send_auditee_monitoring');
// SUBMIT FIDNING FOLLOW-UP MANAGEMENT ACTION
Route::post('/submit_mgtaction1/{id}', 'ManagementActionController@submit_mgtaction1');
// GET MONITORING - IAS MONITOR 
Route::post('/get_monitoring/{id}', 'ManagementActionController@get_monitoring');


// GRAPHS
Route::post('/submit_ffu/{id}', 'ManagementActionController@submit_ffu');
Route::post('/submit_sfu/{id}', 'ManagementActionController@submit_sfu');
Route::post('/submit_tfu/{id}', 'ManagementActionController@submit_tfu');

///////////////////////////////////////////////////////////////////// ACTION MONITORING///////////////////////////////////////////////////////////////////////////