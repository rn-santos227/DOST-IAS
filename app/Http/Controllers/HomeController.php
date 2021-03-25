<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\auditors;
use App\iasstaff;
use App\form_001_audit_report;
use App\agency;
use View;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){
        if (Auth::user()->role == 1) {
            return view('admin_home');
        }else if(Auth::user()->role == 6){
            $auditors = Auditors::pluck('name','user_id')->toArray();
            $secretariats = IasStaff::pluck('name','user_id')->toArray();
            $scopes = form_001_audit_report::pluck('scope_audit')->toArray();
            $scopesf = form_001_audit_report::pluck('scope_audit');
            $agencies = Agency::pluck('name', 'id')->toArray();
            $id = Auth::user()->agency;
            $form001s = form_001_audit_report::where('agency_id', '=', $id)->whereIn('for_management_action', ['i', 1, 2, 3, 'f'])->orderBy('updated_at', 'desc')->get();
            return View::make('auditee.auditee_home')
            ->with('auditors', $auditors)
            ->with('secretariats', $secretariats)
            ->with('form001s', $form001s)
            ->with('scopes', $scopes)
            ->with('scopesf', $scopesf)
            ->with('agencies', $agencies);
        }else{
            $auditors = Auditors::get();
            return View::make("home")->with('auditors', $auditors);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function auditreporthome()
    {
        if (Auth::user()->role == 1) {
            return view('admin_home');
        }elseif(Auth::user()->role == 6){
            $auditors = Auditors::pluck('name','user_id')->toArray();
            $secretariats = IasStaff::pluck('name','user_id')->toArray();
            $scopes = form_001_audit_report::pluck('scope_audit')->toArray();
            $scopesf = form_001_audit_report::pluck('scope_audit');
            $agencies = Agency::pluck('name', 'id')->toArray();
            $id = Auth::user()->agency;
            $form001s = form_001_audit_report::where('agency_id', '=', $id)->whereIn('for_management_action', ['i', 1, 2, 3, 'f'])->orderBy('updated_at', 'desc')->get();
            return View::make('auditee.auditee_home')
            ->with('auditors', $auditors)
            ->with('secretariats', $secretariats)
            ->with('form001s', $form001s)
            ->with('scopes', $scopes)
            ->with('scopesf', $scopesf)
            ->with('agencies', $agencies);

        }elseif(Auth::user()->role == 4){

            $auditors = Auditors::pluck('name','user_id')->toArray();
            $secretariats = IasStaff::pluck('name','user_id')->toArray();
            $scopes = form_001_audit_report::pluck('scope_audit')->toArray();
            $scopesf = form_001_audit_report::pluck('scope_audit');
            $agencies = Agency::pluck('name', 'id')->toArray();
            $id = Auth::user()->id;
            $form001s = form_001_audit_report::whereRaw('find_in_set('.$id.', tleader_id)')->orwhereRaw('find_in_set('.$id.', amember_id)')->orderBy('updated_at', 'desc')->get();
            $form001approval = form_001_audit_report::whereRaw('find_in_set('.$id.', tleader_id)')->orwhereRaw('find_in_set('.$id.', amember_id)')->where('status', '=', '')->get();
            $form001approved = form_001_audit_report::whereRaw('find_in_set('.$id.', tleader_id)')->orwhereRaw('find_in_set('.$id.', amember_id)')->where('status', '=', 1)->where('for_management_action', '=', '')->orderBy('updated_at', 'desc')->get();
            $form001me = form_001_audit_report::whereRaw('find_in_set('.$id.', tleader_id)')->orwhereRaw('find_in_set('.$id.', amember_id)')->where('status', '=', 1)->where('for_management_action', '!=', ' ')->orderBy('updated_at', 'desc')->get();



            // print_r($mem_id);
            return View::make('encoder.encoder_home')
            ->with('auditors', $auditors)
            ->with('secretariats', $secretariats)
            ->with('form001s', $form001s)
            ->with('form001approval', $form001approval)
            ->with('form001approved', $form001approved)
            ->with('form001me', $form001me)
            ->with('scopes', $scopes)
            ->with('scopesf', $scopesf)
            ->with('agencies', $agencies);

        }else{
            $auditors = Auditors::pluck('name','user_id')->toArray();
            $secretariats = IasStaff::pluck('name','user_id')->toArray();
            $scopes = form_001_audit_report::pluck('scope_audit')->toArray();
            $scopesf = form_001_audit_report::pluck('scope_audit');
            $agencies = Agency::pluck('name', 'id')->toArray();
            $form001s = form_001_audit_report::orderBy('updated_at', 'desc')->get();
            $form001approval = form_001_audit_report::where('status', '=', '')->orderBy('updated_at', 'desc')->get();
            $form001approved = form_001_audit_report::where('status', '=', 1)->where('for_management_action', '=', '')->orderBy('updated_at', 'desc')->get();
            $form001me = form_001_audit_report::where('status', '=', 1)->where('for_management_action', '!=', ' ')->orderBy('updated_at', 'desc')->get();
            return View::make('encoder.encoder_home')
            ->with('auditors', $auditors)
            ->with('secretariats', $secretariats)
            ->with('form001s', $form001s)
            ->with('form001approval', $form001approval)
            ->with('form001approved', $form001approved)
            ->with('form001me', $form001me)
            ->with('scopes', $scopes)
            ->with('scopesf', $scopesf)
            ->with('agencies', $agencies);
        }
             
    }
}
