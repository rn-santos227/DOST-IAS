<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\form_001_audit_report;
use App\formcontent;
use App\fileUpload;
use App\comments;
use App\Auditees;
use View;
use Auth;
use PDF;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Redirect;
use App;

class PDFController extends Controller
{
    public function form001PDFDownload($id){
    	PDF::setHeaderCallback(function($pdf) {

          	$border_style = array('all' => array('width' => 0.2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0)); 

         	$num_page = $pdf->getAliasNumPage();
          
            $pdf->SetY(10.5);
            $pdf->SetFont('helvetica', 'B', 10);


            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Rect(15, 10, 42.4, 15, 'DF', $border_style);
            $pdf->Text(25, 15, 'Area of Audit');
            
            
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Rect(57.4, 10, 11.2, 15, 'DF', $border_style);
            $pdf->Text(60, 15, 'No.');
            
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Rect(68.7, 10, 90, 15, 'DF', $border_style);
            $pdf->Text(85, 15, 'Internal Audit Findings/Observations');
            
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Rect(158.7, 10, 80, 15, 'DF', $border_style);
            $pdf->Text(170, 15, 'Internal Audit Recommendations');
            
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Rect(238, 10, 44, 15, 'DF', $border_style);
            $pdf->Text(243, 15, 'Management Actions');

            $pdf->SetY(20.5);
              // Set font
            $pdf->SetFont('helvetica', 'I', 8);
              // Page number
            $pdf->Cell(0, 9, '__________________________________________________________________________________________________________________________________________________________________________', 0, false, 'C', 0, '', 0, false, 'T', 'M');

      });
    
      PDF::setFooterCallback(function($pdf) {
        $pdf->SetY(-31);
        $pdf->SetFont('helvetica', 'R', 8);

        $pdf->Cell(0, 10, '__________________________________________________________________________________________________________________________________________________________________________', 0, false, 'C', 0, '', 0, false, 'T', 'M');

        $pdf->ln();
        $pdf->Cell(525, 1, 'Page '.$pdf->getAliasNumPage().' of '.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });

        $form001 = form_001_audit_report::findOrFail($id);

        $sample = ' <div style="text-align:center;" >
                      <strong>DEPARTMENT OF SCIENCE AND TECHNOLOGY<br>
                      Internal Audit Service</strong>
                    <h4>AUDIT FINDINGS/OBSERVATIONS & RECOMMENDATIONS</h4>
                  </div>';
      $tbl_header = '<table style="width: 638px;" cellspacing="0" cellpadding="5px" border="0.1" margin="100" style="font-family:helvetica;">';
      $tbl_footer = '</table>';

      $tblinfo = '
        <tr>
            <th><b>'.agency_name($form001['agency_id']).'</b></th>
            <th><b>Date of Audit: </b>'.date("F Y", strtotime($form001['datefrom'])). ' - ' . date("F Y", strtotime($form001['dateto'])) . '</th>
          </tr>
          <tr>
            <td>'.$form001['supervisor'].'</td>
            <td rowspan="1"><b>Areas Audited: </b></td>
          </tr>
          <tr>
            <td><b>Audit team Leader: </b>'.auditor($form001['tleader_id']).'<br><br><b>Members: </b></td>
            <td rowspan="4" style="height: 280px;"><b>Auditees: </b><br><br></td>
          </tr>
          <tr>
            <td><b>Overseer: </b>'.$form001['overseer'].'</td>
            
          </tr>
          <tr>
            <td style="height: 235.6px;"><b>Secretariat: </b></td>
          </tr>
      ';      

      $tbl_headers = '<table style="width: 638px;" cellspacing="0" cellpadding="5px" border="0.1" margin="100" style="font-family:helvetica;">';
      $tbl_footers = '</table>';
      $tbl = '';

      $tblinfos = '
        <tr>
          <th><b>Background: </b>'.$form001['background'].'<b>Methodology: </b>'.$form001['goodpoint'].'</th>
        </tr>';

      $tbl_headerc = '<table style="width: 638px;" cellspacing="0" cellpadding="5px" border="0.1" margin="100" style="font-family:helvetica;">';
      $tbl_footerc = '</table>';
      $tblinfoc = '';

      $formcontent = formcontent::where('form_001_id', $id)->get();
      foreach ( $formcontent as $row ) {

      $tblinfoc .= '
          <tr style="font-size: 10px !important; font-family: Arial, Helvetica, sans-serif;">
            <td style="border: 0.5px solid #000000; width: 120px; text-align:center; "><b>'.$row['audit_area'].'</b><br /><br /><i>'.$row['sub_auditarea'].'</i></td>
            <td style="border: 0.5px solid #000000; width: 32px; text-align:center; ">'.$row['auditfinding_no'].'</td>
            <td style="border: 0.5px solid #000000; width: 255px; text-align:justify">'.$row['auditfinding'].'</td>
            <td style="border: 0.5px solid #000000; width: 225px; text-align:justify">'.$row['auditrecommend'].'</td>
            <td style="border: 0.5px solid #000000; width: 123px; text-align:justify"></td>
          </tr>';
          
      }

      $tblsignatories = '<br><br><br><b>Audit Report Prepared/Submitted by: </b> <br><br><br>';

      $tblsignatories_h = '<br><br><table style="width: 638px;" border="0" margin="100" style="font-family:helvetica;">';
      $tblsignatories_f = '</table>';
      $tblsignatories_b = '<tr><td>' . auditor_leader($form001['tleader_id']) . '</td>';



      foreach ( explode(',', $form001['amember_id']) as $row ) {

      $tblsignatories_b .= '<td>' . auditor_member($row) . '</td>';

      }

      $tblsignatories_b .= '</tr>';

      $tblsignatories_b .= '<tr><td style="width:500px;"><b>' . $form001['overseer'] . '</b><br>Director, IAS</td></tr>';

      $tblsignatories_b .= '<br><tr>';

      foreach ( explode(',', $form001['secretariat_id']) as $row ) {

      $tblsignatories_b .= '<td>' . secretariat($row) . '</td>';

      }

      $tblsignatories_b .= '</tr>';


      PDF::SetAuthor('System');
      PDF::SetTitle('My Report');
      PDF::SetSubject('Report of System');
      PDF::SetMargins(15, 26.5, 15.5);
      PDF::SetFontSubsetting(false);
      PDF::SetFontSize('10px');   
      PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);  
      PDF::SetPrintHeader(false);
	    PDF::SetPrintFooter(false);   
      PDF::AddPage('L', 'A4');
      PDF::writeHTML($sample . $tbl_header . $tblinfo .  $tbl_footer,  true, false, false, false, '');
      PDF::SetPrintHeader(true);
	    PDF::SetPrintFooter(true);
      PDF::AddPage('L', 'A4');
      PDF::writeHTML($tbl_headers . $tblinfos .  $tbl_footers,  true, false, false, false, '');
      PDF::AddPage('L', 'A4');
      PDF::writeHTML($tbl_headerc . $tblinfoc .  $tbl_footerc,  true, false, false, false, '');
      PDF::SetPrintHeader(false);
      PDF::AddPage('L', 'A4');
      PDF::writeHTML($tblsignatories . $tblsignatories_h . $tblsignatories_b . $tblsignatories_f,  true, false, false, false, '');
      PDF::lastPage();
      PDF::Output('my_file.pdf', 'I');
    }


}
