<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\form_001_audit_report;
use App\formcontent;
use App\fileUpload;
use App\comments;
use App\Auditees;
use App\afrecommendation;
use View;
use Auth;
use PDF;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Redirect;

class Form001Controller extends Controller
{
    public function index($id){
        $form001s = form_001_audit_report::where('id', $id)->get();
        $scopes = form_001_audit_report::where('id', $id)->pluck('scope_audit');
        $a_findings = formcontent::where('form_001_id', $id)->where('subof', '=', '')->orderBy('id', 'asc')->get();

        // Session::flash('error_msg', 'Please fill up all the fields!');
        // Session::flash('success_msg', 'Audit Finding and Recommendations has been created!');
        // version 2 - comment:  return View::make('encoder.view_form001_content')
        return View::make('encoder.view_form001_content_v2')
        ->with('form001s', $form001s)
        ->with('scopes', $scopes)
        ->with('a_findings', $a_findings)
        ->with(compact('id', $id));
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
        $f_001 = form_001_audit_report::create([
            'audit_form_id' => ' ',
            'agency_id' => $request['agencies'],
            'pap' => !$request['pap'] ? ' ' : $request['pap'],
            'supervisor' => $request['isupervisor'],
            'tleader_id' => $request['tleader'],
            'amember_id' => $request['audit_m'],
            'overseer'=> $request['overseer'],
            'secretariat_id' => $request['sec'],
            'datefrom' => $request['datefrom'],
            'dateto' => $request['dateto'],
            'scope_audit' => $request['sa'],
            'auditees' => $request['auditees'],
            'background' => !$request['background'] ? ' ' : $request['background'],
            'goodpoint' => !$request['goodpoint'] ? ' ' : $request['goodpoint'],
            'author_id' => Auth::user()->id,
            'status' => ' ',
            'close' => ' ',
            'open' => ' ',
            'for_management_action' => ' ',
            'receiver' => ' '

        ]);

        $user = User::where('email', '=', agency_email($request['agencies']))->first();
        if ($user === null) {
            $auditee = Auditees::create([
            'agency_id' => $request['agencies'],
            'username' => strtolower(agency_code($request['agencies'])),
            'password' => bcrypt('dost'.agency_code($request['agencies'])),
            'email' => agency_email($request['agencies']),
            'role' => 6,
          ]);

          $u_iasstaff = User::create([
              'title' => ' ',
              'name' => agency_name($request['agencies']),
              'username' => agency_code($request['agencies']),
              'agency' => $request['agencies'],
              'position' => ' ',
              'email' => agency_email($request['agencies']),
              'nickname' => ' ',
              'agency_email' => agency_email($request['agencies']),
              'contact' => ' ',
              'role' => 6,
              'password' => bcrypt('dost'.agency_code($request['agencies'])),
          ]);

          
        }

        $id = $f_001->id;
        return $id;
        
    }

    /**
     * Store the FORM OO1 Content.
     *
     * @param  int  $id
     * @return Response
     */
    public function storecontent(Request $request, $id)
    {
        $c_audit = formcontent::where('form_001_id', $id)->where('subof', '=', '')->count();

        $f_content = formcontent::create([
            'form_001_id' => $id,
            'auditfinding_no' => $c_audit + 1,
            'subof' => '',
            'author_id' => Auth::user()->id,
            'main_area' => $request['tag_a'],
            'audit_area' => $request['c_audit'] ? ' ' : $request['scope_a'],
            'custom_auditarea' => !$request['c_audit'] ? ' ' : $request['c_audit'],
            'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
            'custom_subauditarea' => !$request['c_subaudit'] ? ' ' : $request['c_subaudit'],
            'auditfinding'=> $request['findings'],
            'auditrecommend' => '',
            'auditmanageaction' => ' ',
            'action_by' => ' ',
            'status' => ' ',
            'archive_status' => 0,
            

        ]);

        Session::flash('success_msg', 'Audit Finding has been successfully created!');

        $a_area = ' ';

        if ($f_content->audit_area == ' ') {
          $a_area = $f_content->custom_auditarea;
        } else {
          $a_area = $f_content->audit_area;
        }
        

        $dataArray = array('auditfinding_no'=>$f_content->auditfinding_no,
                           'subof'=>$f_content->subof,
                           'audit_area'=> $a_area, 
                           'sub_auditarea'=> $f_content->sub_auditarea, 
                           'author_id'=> author($f_content->author_id),
                           'created_at'=> date('F j, Y \a\t g:i a', strtotime($f_content->created_at)));
                
        return json_encode($dataArray); 

        // return response()->json($f_content);

        // print_r($id);
        
    }

    public function storesubcontent(Request $request, $id, $idafno){
        $afitem = formcontent::where('form_001_id', $id)->where('auditfinding_no', $idafno)->first();
        $c_audit = formcontent::where('form_001_id', $id)->where('subof', $idafno)->count();
        $alphabet = array('B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');


        $f_content = formcontent::create([
            'form_001_id' => $id,
            // 'auditfinding_no' =>  $c_audit == 0 ? $idafno.'.'.$alphabet[0] : $idafno.'.'.$alphabet[$c_audit-1],
            'auditfinding_no' =>  $idafno.'.'.$alphabet[$c_audit],
            'subof' => $idafno,
            'author_id' => Auth::user()->id,
            'main_area' => $afitem['main_area'],
            'audit_area' => !$afitem['audit_area'] ? $afitem['custom_auditarea'] : $afitem['audit_area'],
            'custom_auditarea' => !$afitem['custom_auditarea'] ? ' ' : $afitem['custom_auditarea'],
            'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
            'custom_subauditarea' => !$afitem['custom_subauditarea'] ? ' ' : $afitem['custom_subauditarea'],
            'auditfinding'=> $request['anotherfinding'],
            'auditrecommend' => '',
            'auditmanageaction' => ' ',
            'action_by' => ' ',
            'status' => ' ',
            'archive_status' => 0,
            

        ]);

        Session::flash('success_msg', 'Audit Finding and Recommendations has been created!');

        $a_area = ' ';

        if ($f_content->audit_area == ' ') {
          $a_area = $f_content->custom_auditarea;
        } else {
          $a_area = $f_content->audit_area;
        }
        

        return response()->json($arrayName = array('f_content' => $f_content));
 

        // return response()->json($f_content);
      
// echo $alphabet[3]; // returns D

// echo array_search('D', $alphabet);

        // print_r($idafno.'.'.$alphabet[1-$c_audit]);
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function view_af(Request $request)
    {

      $f_id = $request->f_id;
      $id_c = $request->id_c;
      $finding = formcontent::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
      $subfinding = formcontent::where('subof', $request->id_c)->where('form_001_id', $request->f_id)->get();
      $recommendations = afrecommendation::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->get();
      $rcomment = comments::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->where('comment_type', '=', 'r')->orderBy('created_at', 'desc')->get();
      $fcomment = comments::where('auditfinding_no', $id_c)->where('form_001_id', $request->f_id)->where('comment_type', '=', 'f')->orderBy('created_at', 'desc')->get();
      return response()->json($arrayName = array('finding' => $finding, 'subfinding' => $subfinding, 'recommendations' => $recommendations, 'rcomment' => $rcomment, 'fcomment' => $fcomment));

      // return  $f_id;
        // print_r($finding);
        
    }

    public function updatefindingdetails(Request $request, $id){
      $update_af_d = formcontent::where('auditfinding_no', $id)->where('form_001_id', $request['_ids'])
                  ->update([
                    'main_area' => $request['tag_a_u'],
                    'audit_area' => $request['c_audit_u'] ? ' ' : $request['scope_a_u'],
                    'custom_auditarea' => !$request['c_audit_u'] ? ' ' : $request['c_audit_u'],
                    'sub_auditarea' => !$request['s_audit_u'] ? ' ' : $request['s_audit_u'],
                    'custom_subauditarea' => !$request['c_subaudit_u'] ? ' ' : $request['c_subaudit_u'],
                    ]);
      // print_r($id);
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
    public function update_af(Request $request, $id)
    {

      if($request['findings'] == '' && $request['recommendations'] == ''){
        $update_af = formcontent::where('auditfinding_no', $id)->where('form_001_id', $request['_id'])
                  ->update([
                    'main_area' => $request['tag_a'],
                    'audit_area' => $request['c_audit'] ? ' ' : $request['scope_a'],
                    'custom_auditarea' => !$request['c_audit'] ? ' ' : $request['c_audit'],
                    'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
                    'custom_subauditarea' => !$request['c_subaudit'] ? ' ' : $request['c_subaudit'],
                    ]);
        // return 'Audit Finding Item has been successfully updated!';

       $dataArray = array('custom_auditarea'=> $request['c_audit'] ? $request['c_audit'] : $request['scope_a'], 
               'sub_auditarea'=> $request['s_audit']);
                
        return json_encode($dataArray); 

      }elseif ($request['findings'] != '' && $request['recommendations'] == '') {
        $update_af = formcontent::where('auditfinding_no', $id)->where('form_001_id', $request['_id'])
                  ->update([
                    'main_area' => $request['tag_a'],
                    'audit_area' => $request['c_audit'] ? ' ' : $request['scope_a'],
                    'custom_auditarea' => !$request['c_audit'] ? ' ' : $request['c_audit'],
                    'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
                    'custom_subauditarea' => !$request['c_subaudit'] ? ' ' : $request['c_subaudit'],
                    'auditfinding'=> $request['findings']
                    ]);
        
        $dataArray = array('custom_auditarea'=> $request['c_audit'] ? $request['c_audit'] : $request['scope_a'], 
               'sub_auditarea'=> $request['s_audit']);
                
        return json_encode($dataArray); 

      }elseif ($request['findings'] == '' && $request['recommendations'] != '') {
        $update_af = formcontent::where('auditfinding_no', $id)->where('form_001_id', $request['_id'])
                  ->update([
                    'main_area' => $request['tag_a'],
                    'audit_area' => $request['c_audit'] ? ' ' : $request['scope_a'],
                    'custom_auditarea' => !$request['c_audit'] ? ' ' : $request['c_audit'],
                    'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
                    'custom_subauditarea' => !$request['c_subaudit'] ? ' ' : $request['c_subaudit'],
                    'auditrecommend'=> $request['recommendations']
                    ]);
        
        $dataArray = array('custom_auditarea'=> $request['c_audit'] ? $request['c_audit'] : $request['scope_a'], 
               'sub_auditarea'=> $request['s_audit']);
                
        return json_encode($dataArray); 

      }elseif ($request['findings'] != '' && $request['recommendations'] != '') {
        $update_af = formcontent::where('auditfinding_no', $id)->where('form_001_id', $request['_id'])
                  ->update([
                    'main_area' => $request['tag_a'],
                    'audit_area' => $request['c_audit'] ? ' ' : $request['scope_a'],
                    'custom_auditarea' => !$request['c_audit'] ? ' ' : $request['c_audit'],
                    'sub_auditarea' => !$request['s_audit'] ? ' ' : $request['s_audit'],
                    'custom_subauditarea' => !$request['c_subaudit'] ? ' ' : $request['c_subaudit'],
                    'auditfinding'=> $request['findings'],
                    'auditrecommend'=> $request['recommendations']
                    ]);
        
        $dataArray = array('custom_auditarea'=> $request['c_audit'] ? $request['c_audit'] : $request['scope_a'], 
               'sub_auditarea'=> $request['s_audit']);
                
        return json_encode($dataArray); 

      }else {
          return 'Update Failed';
      }
        

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function archive_af_true($id) 
    {
      $fc = formcontent::findOrFail($id);

      $fc->archive_status = 1;

      $fc->save();

      return 'Item successfully archived!';
    }

    public function unarchive_af_true($id) 
    {
      $fc = formcontent::findOrFail($id);

      $fc->archive_status = 0;

      $fc->save();

      return 'Item successfully unarchived!';
    }


    public function getvu_form001($id){
      $form001 = form_001_audit_report::findOrFail($id);
      return response()->json($form001);
    }

    public function update_auditreport(Request $request, $id){
      $getVal = form_001_audit_report::findOrFail($id);
      $update_af = form_001_audit_report::where('id', $id)
                  ->update([
                    'audit_form_id' => ' ',
                    'agency_id' => $request['vu_agencies'],
                    'pap' => !$request['vu_pap'] ? ' ' : $request['vu_pap'],
                    'supervisor' => $request['vu_isupervisor'],
                    'tleader_id' => $request['vu_tleader'],
                    'amember_id' => $request['vu_audit_m'],
                    'overseer'=> $request['vu_overseer'],
                    'secretariat_id' => $request['vu_sec'],
                    'datefrom' => $request['vu_datefrom'],
                    'dateto' => $request['vu_dateto'],
                    'scope_audit' => $request['vu_sa'],
                    'auditees' => !$request['vu_auditees'] ? $getVal['auditees'] : $request['vu_auditees'],
                    'background' => !$request['vu_background'] ? $getVal['background'] : $request['vu_background'],
                    'goodpoint' => !$request['vu_goodpoint'] ? $getVal['goodpoint'] : $request['vu_goodpoint'],
                    'author_id' => Auth::user()->id,
                    'status' => ' ',
                    'close' => ' ',
                    'open' => ' ',
                    'for_management_action' => ' ',
                    'receiver' => ' '
                    ]);

        return 'Audit Report has been successfully updated!';

               
    }

    public function upload(Request $request){

        $MIME = array(
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',

            // ms office
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        if($request->file('c_file')->getSize()>21073741824){
            return 'Too large';
        }
        else if(!in_array($request->file('c_file')->getMimetype(), $MIME)){
            return 'Invalid';
        }

        else{
            if($request->file('c_file') != null){
                if($request->file('c_file')->getSize()<21073741824){
                    $quality = 60;
                    $file=$request->file('c_file');
                    $orFile = $file->getClientOriginalName();
                    $filename = $orFile;
                    $request->file('c_file')->move(public_path("/files"), $filename);


                    $uploadfile = fileUpload::create([
                      'form_001_id' => $request['form001noc'],
                      'auditfinding_no' => $request['afnoc'],
                      'filename' => $request['file_name'],
                      'description' => $request['file_desc'],
                      'file' => $filename,
                      'filetype' => ' ',
                      'uploaded_by'=> Auth::user()->name,
                      'secretariat_id' => $request['sec'],
                      'status' => 1,
                      'archive_status' => 1

                  ]);

                  $c_id = $uploadfile->auditfinding_no;
                  $f_id = $uploadfile->form_001_id;
                  $getfile = fileUpload::where('auditfinding_no', $c_id)->where('form_001_id', $f_id)->get();
                  return response()->json($getfile);
                }
            }
            else{
                $fphoto = '';
            }
        }
    }

    public function get_support_doc(Request $request, $id){

        $c_id = $request->id;
        $f_id = $request->fno;
        $getfile = fileUpload::where('auditfinding_no', $id)->where('form_001_id', $f_id)->get();
        return response()->json($getfile);

        // print_r($file->filename);

    }


    public function updatefinding(Request $request, $id){
      $afrecommendation = formcontent::where('id', $id)
                ->update([
                  'auditfinding' => $request['findings_u']
                  ]);

      $dataArray = array('auditfinding'=> $request['findings_u']);
              
      return response()->json($dataArray);
          
    }

    public function add_rcomment(Request $request, $id){

      

        $addcomment = comments::create([
            'form_001_id' => $request['_id'],
            'auditfinding_no' => $id,
            'comment' => $request['recommendation_comment1'],
            'comment_type' => 'r',
            'comment_by' => Auth::user()->name,
            'status' => ' '

        ]);

        if (Auth::user()->role == 5) {
          formcontent::where('auditfinding_no', $id)->where('form_001_id', $addcomment->form_001_id)->update(['status' => 1]);
        }

        
        $getcomment = comments::where('auditfinding_no', $id)->where('form_001_id', $addcomment->form_001_id)
                    ->where('comment_type', '=', 'r')
                    ->orderBy('created_at', 'desc')->get();
        return response()->json($getcomment);

        // return 'sucess';

    }

    public function add_fcomment(Request $request, $id){

      

        $addcomment = comments::create([
            'form_001_id' => $request['_id'],
            'auditfinding_no' => $id,
            'comment' => $request['findings_comment1'],
            'comment_type' => 'f',
            'comment_by' => Auth::user()->name,
            'status' => ' '

        ]);

        if (Auth::user()->role == 5) {
          formcontent::where('auditfinding_no', $id)->where('form_001_id', $addcomment->form_001_id)->update(['status' => 1]);
        }

        $getcomment = comments::where('auditfinding_no', $id)->where('form_001_id', $addcomment->form_001_id)
                    ->where('comment_type', '=', 'f')
                    ->orderBy('created_at', 'desc')->get();
        return response()->json($getcomment);

        // return 'sucess';

    }

    public function getf_comment (Request $request){

        $id = $request->id;
        $fid = $request->f_id;
        $getfile = comments::where('auditfinding_no', $id)->where('form_001_id', $fid)
                    ->where('comment_type', '=', 'f')
                    ->orderBy('created_at', 'desc')->get();
        return response()->json($getfile);

    }

    public function getr_comment (Request $request){

        $id = $request->id;
        $fid = $request->f_id;
        $getfile = comments::where('auditfinding_no', $id)->where('form_001_id', $fid)
                    ->where('comment_type', '=', 'r')
                    ->orderBy('created_at', 'desc')->get();
        return response()->json($getfile);

    }


    public function approve_item($id){
        $approve = formcontent::where('id', $id)->update(['status' => 2]);
        return response()->json($id);
    }

    public function approve_report($id){
        $approve = form_001_audit_report::where('id', $id)->update(['status' => 1]);
        // 1 = approve

        $approve_item = formcontent::where('form_001_id', $id)->update(['status' => 2]);
        // 2 = approve
        // return response()->json($id);

    }

    public function cancel_approve_report($id){
        $cancel_approve = form_001_audit_report::where('id', $id)->update(['status' => 0]);
    }

    public function send_to_auditee($id){
        $send = form_001_audit_report::where('id', $id)->update(['for_management_action' => 'i', 'receiver' => 1]);
        // i = initial management action

        $reports_monitoring = form_001_audit_report::whereIn('for_management_action', ['i', 'f', 1, 2, 3])->get();

        return View::make('monitoring.monitoring_home')
                   ->with('reports_monitoring', $reports_monitoring);

        // return Redirect::to('/monitoring-reports');
    }
}
