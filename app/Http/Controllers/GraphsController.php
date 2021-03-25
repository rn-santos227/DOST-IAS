<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agency;
use App\formcontent;
use App\form_001_audit_report;
use Session;


class GraphsController extends Controller
{
    public function get_co_graph(){
    	$formcontentagencyid = form_001_audit_report::pluck('agency_id');
      $form001 = agency::where('agencygroup', '=', 'DOST-CO' )->orderBy('code', 'ASC')->pluck('code');
      $pesto = formcontent::where('form_001_id', 1)->where('main_area', 1)->count();
      $pesf = formcontent::where('form_001_id', 1)->where('main_area', 2)->count();
      $pesas = formcontent::where('form_001_id', 1)->where('main_area', 2)->count();
      return response()->json($arrayName = array('form001' => $form001,
      											'pesto' => $pesto,
      											'pesf' => $pesf,
      											'pesas' => $pesas	));
    }
}
  