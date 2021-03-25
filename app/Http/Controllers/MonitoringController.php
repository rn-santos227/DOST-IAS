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
use View;
use Auth;
use PDF;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Redirect;

class MonitoringController extends Controller
{
    public function index($id){
        $form001s = form_001_audit_report::where('id', $id)->orderBy('created_at', 'desc')->get();
        $scopes = form_001_audit_report::where('id', $id)->pluck('scope_audit');
        $a_findings = formcontent::where('form_001_id', $id)->orderBy('id', 'asc')->get();

        // Session::flash('error_msg', 'Please fill up all the fields!');
        // Session::flash('success_msg', 'Audit Finding and Recommendations has been created!');

        return View::make('monitoring.view_monitoring_items')
        ->with('form001s', $form001s)
        ->with('scopes', $scopes)
        ->with('a_findings', $a_findings)
        ->with(compact('id', $id));
    }

    public function first_followup($id){
        $form001s = form_001_audit_report::where('id', $id)->get();
        $scopes = form_001_audit_report::where('id', $id)->pluck('scope_audit');
        $a_findings = formcontent::where('form_001_id', $id)->orderBy('id', 'asc')->get();

        return View::make('monitoring.partials_followup_views.view_first_followup_items')
        ->with('form001s', $form001s)
        ->with('scopes', $scopes)
        ->with('a_findings', $a_findings)
        ->with(compact('id', $id));
    }
}
