<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\formcontent;
use App\form_001_audit_report;
use App\managementAction;
use bicpi\HtmlConverter\Converter\Html2TextConverter;
use Carbon\Carbon;
use Session;

class WordController extends Controller
{
    public function createWord($id){
    	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    	$sectionStyle = array(
		    'orientation' => 'landscape',
		    'marginLeft' => 600,
		    'marginRight' => 900,
		    'marginTop' => 900,
		    'marginBottom' => 900

		);

		$tableStyle = array(
		    'borderColor' => '00000',
		    'borderSize'  => 1,
		    'cellMargin'  => 50000,
		    'cellMarginTop'=>80,
			  'cellMarginLeft'=>80,
			  'cellMarginRight'=>80,
			  'cellMarginBottom'=>80

		);

		

		$headerStyle = array(
		    'headerHeight'  => 500
		);

		$firstPageHeader = array(
		    'spaceAfter'=>0,  
		    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,
		    'size'    => '8',
		);


		$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center' );
		$cellAuditCon = array('vMerge' => 'restart');
		$cellVlign = array('valign' => 'center' );
		$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH);
		$cellHeaderCentered = array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$cellVCentered = array('valign' => 'center');
		$cellRowRestart = array('vMerge' => 'continue');
		$cellColSpan = array('gridSpan' => 2);

		
    	$section = $phpWord->addSection($sectionStyle);

		$header = $section->createHeader($headerStyle, $cellVCentered);
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText('IAS Form 001', array('bold'=>false, 'size'=> 8)); 
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText('Rev.0/June 2012', array('bold'=>false, 'size'=> 8)); 
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText();
		$header->firstPage();

		// - FIRST PAGE DATA - 

			
		$header = $section->createHeader($headerStyle, $cellVCentered);
		$tableH = $header->addTable($tableStyle);
		$tableH->addRow(870);
		$cell1 = $tableH->addCell(2310, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, $cellVCentered);
		$textrun1->addText('Area of Audit');

		$cell1 = $tableH->addCell(980, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, $cellVCentered);
		$textrun1->addText('No.');

		$cell1 = $tableH->addCell(6100, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered);
		$textrun1->addText('Internal Audit Findings/Observations');

		$cell1 = $tableH->addCell(6150, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered);
		$textrun1->addText('Internal Audit Recommendations');

		$cell1 = $tableH->addCell(2660, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered);
		$textrun1->addText('Management Actions');

		// ---------------------- END SECOND HEADER ------------------------

		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('DEPARTMENT OF SCIENCE AND TECHNOLOGY', array('bold'=>true)); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('Internal Audit Service', array('bold'=>true));
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('INTERNAL AUDIT FINDINGS/OBSERVATIONS RECOMMENDATIONS', array('bold'=>true));
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		
		$table = $section->addTable($tableStyle);
		// $id = 1;
		$form001 = form_001_audit_report::findOrFail($id);

		$table->addRow();
		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText(htmlspecialchars(upperagency_name($form001['agency_id'])), array('bold'=>true));

		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Date of Audit:  ', array('bold'=>true));
		$textrunH->addText(htmlspecialchars(date("F Y", strtotime($form001['datefrom'])). ' - ' . date("F Y", strtotime($form001['dateto']))));
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000, $cellVlign);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText(htmlspecialchars($form001['supervisor']), array('bold'=>true));
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Supervisor, '.htmlspecialchars(agency_name($form001['agency_id'])), array('bold'=>false));

		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Areas Audited:  ', array('bold'=>true));
		$textrunH->addText(htmlspecialchars($form001['scope_audit']), array('bold'=>false));
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000, $cellVlign);
		$html = '<b>Audit Team Leader:</b>'.auditor_leader($form001['tleader_id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$html = '<b>Members:</b>'.auditor_members_report($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		// $textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		// $textrunH->addText('Audit Team Leader:  '.htmlspecialchars(auditor_leader(18)), array('bold'=>true));
		// $textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		// $textrunH->addText('Supervisor, '.htmlspecialchars(agency_name($form001['agency_id'])), array('bold'=>false));

		$cellH = $table->addCell(8000, $cellRowRestart);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$html = '<b>Auditees:</b>'.auditees($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000);
		$html = '<b>Overseer:</b> Engr. Maria Teresa B. De Guzman – Director, IAS ';
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$table->addCell(null, $cellRowRestart);

		$table->addRow();
		$cellH = $table->addCell(8000);
		$html = '<b>Secretariat:</b>'.secretariats($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$table->addCell(null, $cellRowRestart, $cellRowSpan);



		// ---------------------END FIRST PAGE ----------------------
		$section2 = $phpWord->addSection($sectionStyle);
		$table = $section2->addTable($tableStyle);
		// $id = 1;
		$form001 = form_001_audit_report::findOrFail($id);

		$table->addRow();
		$cellH = $table->addCell(16000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Background:  ', array('bold'=>true));
		$html = $form001['background'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);

		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Methodology:  ', array('bold'=>true));
		$html = $form001['goodpoint'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);

      	// ----------------END SECOND PAGE-------------------------

		$sectionBody = $phpWord->addSection($sectionStyle);
		$table = $sectionBody->addTable($tableStyle);

		$formcontent = formcontent::where('form_001_id', $id)->orderBy('id', 'ASC')->get();
		$cellColSpan = array('gridSpan' => 5);
		$previousValue = ' ';
		$previousValue1 = ' ';

      	foreach ( $formcontent as $row ) {

      		$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $row['auditfinding_no'])->first();

	      	$a_area = $auditarea['audit_area'];
	      	$c_area = $auditarea['custom_auditarea'];

			if($previousValue != $a_area) {
			 	$table->addRow(300);
				$cell1 = $table->addCell(4000, $cellColSpan);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = '<b>'.$auditarea['audit_area'].'</b>';
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
				$previousValue = $a_area;
			}elseif($previousValue1 != $c_area) {
			 	$table->addRow(300);
				$cell1 = $table->addCell(4000, $cellColSpan);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
				$previousValue1 = $c_area;
			}else{
				
			}
		
			
			

      	$table->addRow(870);
		$cell1 = $table->addCell(1810, $cellAuditCon);
		// $textrun1 = $cell1->addTextRun(array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		// $textrun1->addText($row['custom_auditarea']);
		$textrun1 = $cell1->addTextRun($cellHCentered, $cellVCentered);
		$textrun1->addText(htmlspecialchars($row['sub_auditarea']), array('italic'=>true));


		$cell1 = $table->addCell(1000);
		$textrun1 = $cell1->addTextRun(array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP, 'alignment'=>\PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun1->addText($row['auditfinding_no']);

		$cell1 = $table->addCell(6000, $cellRowSpan);
		$html = $row['auditfinding'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

		$cell1 = $table->addCell(6000, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHCentered);
		$html = $row['auditrecommend'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

		$cell1 = $table->addCell(2980, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHCentered);
		$textrun1->addText('');

      	}


		



      		$agencyId = form_001_audit_report::findOrFail($id);
      		$docName = agency_code($agencyId->agency_id);

		    	// \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

      	\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		    try{
		        $objectWriter->save(storage_path($docName.' Audit Report.docx'));
		    } catch (Exception $e) {
		   
		    }
		 
		return response()->download(storage_path($docName.' Audit Report.docx'));
	}

	public function followUpReport($id, $stage){
    	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    	$sectionStyle = array(
		    'orientation' => 'landscape',
		    'marginLeft' => 600,
		    'marginRight' => 900,
		    'marginTop' => 900,
		    'marginBottom' => 900

		);

		$tableStyle = array(
		    'borderColor' => '00000',
		    'borderSize'  => 1,
		    'cellMargin'  => 50000,
		    'cellMarginTop'=>80,
		  	'cellMarginLeft'=>80,
		  	'cellMarginRight'=>80,
		  	'cellMarginBottom'=>80

		);

		$headerStyle = array(
		    'headerHeight'  => 500
		);

		$firstPageHeader = array(
		    'spaceAfter'=>0,  
		    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,
		    'size'    => '8',
		);


		$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center' );
		$cellAuditCon = array('vMerge' => 'restart');
		$cellVlign = array('valign' => 'center' );
		$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH);
		$cellHeaderCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$cellVCentered = array('valign' => 'center');
		$cellRowRestart = array('vMerge' => 'continue');
		$cellColSpan = array('gridSpan' => 2);

		
    	$section = $phpWord->addSection($sectionStyle);

		$header = $section->createHeader($headerStyle, $cellVCentered);
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText('IAS Form 002', array('bold'=>false, 'size'=> 8)); 
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText('Rev.0/June 2012', array('bold'=>false, 'size'=> 8));
		$textrun = $header->addTextRun($firstPageHeader);
		$textrun->addText();
		$header->firstPage();

		// - FIRST PAGE DATA - 

			
		$header = $section->createHeader($headerStyle, $cellVCentered);
		$tableH = $header->addTable($tableStyle);
		$tableH->addRow(870);
		$cell1 = $tableH->addCell(2000);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Area of Audit', array('bold'=>true));

		$cell1 = $tableH->addCell(600);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('IAF No.', array('bold'=>true));

		$cell1 = $tableH->addCell(4700);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Internal Audit Findings/Observations', array('bold'=>true));

		$cell1 = $tableH->addCell(3100);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Internal Audit Recommendations', array('bold'=>true));

		$cell1 = $tableH->addCell(3100);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Management Actions', array('bold'=>true));

		$cell1 = $tableH->addCell(3100);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText(htmlspecialchars('IAS Monitoring of Corrective Action (CA)/Follow-up Action & other Requirements'), array('bold'=>true)); 	

		$cell1 = $tableH->addCell(2300);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('spaceAfter'=>0, 'textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Status', array('bold'=>true)); 	

		// ---------------------- END SECOND HEADER ------------------------

		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('DEPARTMENT OF SCIENCE AND TECHNOLOGY', array('bold'=>true)); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('Internal Audit Service', array('bold'=>true));
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('INTERNAL AUDIT FINDINGS/OBSERVATIONS RECOMMENDATIONS', array('bold'=>true));
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		
		$table = $section->addTable($tableStyle);
		// $id = 1;
		$form001 = form_001_audit_report::findOrFail($id);

		$table->addRow();
		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText(htmlspecialchars(upperagency_name($form001['agency_id'])), array('bold'=>true));

		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Date of Audit:  ', array('bold'=>true));
		$textrunH->addText(htmlspecialchars(date("F Y", strtotime($form001['datefrom'])). ' - ' . date("F Y", strtotime($form001['dateto']))));
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000, $cellVlign);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText(htmlspecialchars($form001['supervisor']), array('bold'=>true));
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Supervisor, '.htmlspecialchars(agency_name($form001['agency_id'])), array('bold'=>false));

		$cellH = $table->addCell(8000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Areas Audited:  ', array('bold'=>true));
		$textrunH->addText(htmlspecialchars($form001['scope_audit']), array('bold'=>false));
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000, $cellVlign);
		$html = '<b>Audit Team Leader:</b>'.auditor_leader($form001['tleader_id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$html = '<b>Members:</b>'.auditor_members_report($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		// $textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		// $textrunH->addText('Audit Team Leader:  '.htmlspecialchars(auditor_leader(18)), array('bold'=>true));
		// $textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'valign' => 'center', 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		// $textrunH->addText('Supervisor, '.htmlspecialchars(agency_name($form001['agency_id'])), array('bold'=>false));

		$cellH = $table->addCell(8000, $cellRowRestart);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$html = '<b>Auditees:</b>'.auditees($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
// ---------------------------------------------------------------------------------------------------------------------------------------------
		$table->addRow();
		$cellH = $table->addCell(8000);
		$html = '<b>Overseer:</b> Engr. Maria Teresa B. De Guzman – Director, IAS ';
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$table->addCell(null, $cellRowRestart);

		$table->addRow();
		$cellH = $table->addCell(8000);
		$html = '<b>Secretariat:</b>'.secretariats($form001['id']);
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);
		$table->addCell(null, $cellRowRestart, $cellRowSpan);



		// ---------------------END FIRST PAGE ----------------------
		$section2 = $phpWord->addSection($sectionStyle);
		$table = $section2->addTable($tableStyle);
		// $id = 1;
		$form001 = form_001_audit_report::findOrFail($id);

		$table->addRow();
		$cellH = $table->addCell(16000);
		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Background:  ', array('bold'=>true));
		$html = $form001['background'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);

		$textrunH = $cellH->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));
		$textrunH->addText('Methodology:  ', array('bold'=>true));
		$html = $form001['goodpoint'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cellH, $html);

      	// ----------------END SECOND PAGE-------------------------

		$sectionBody = $phpWord->addSection($sectionStyle);
		$table = $sectionBody->addTable($tableStyle);

		$formcontent = formcontent::where('form_001_id', $id)->get();
		$cellColSpan = array('gridSpan' => 7);
		$previousValue = ' ';
		$previousValue1 = ' ';
      	foreach ( $formcontent as $row ) {

      	$followup = managementAction::where('form_001_id', $id)->where('auditfinding_no', $row['auditfinding_no'])->first();

      	$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $row['auditfinding_no'])->first();

      	$a_area = $auditarea['audit_area'];
		$c_area = $auditarea['custom_auditarea'];

		if($previousValue != $a_area) {
		 	$table->addRow(300);
			$cell1 = $table->addCell(4000, $cellColSpan);
			$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
			$html = '<b>'.$auditarea['audit_area'].'</b>';
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$previousValue = $a_area;
		}elseif ($previousValue1 != $c_area) {
			$table->addRow(300);
			$cell1 = $table->addCell(4000, $cellColSpan);
			$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
			$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$previousValue1 = $c_area;
		}else{
			
		}
		
		$previousValue = $a_area;

      	$table->addRow(870);
		$cell1 = $table->addCell(1610, $cellAuditCon);
		$textrun1 = $cell1->addTextRun(array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1 = $cell1->addTextRun($cellHCentered, $cellVCentered);
		$textrun1->addText($row['custom_auditarea']);
		$textrun1->addText(htmlspecialchars($row['sub_auditarea']), array('italic'=>true));


		$cell1 = $table->addCell(600);
		$textrun1 = $cell1->addTextRun(array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP, 'alignment'=>\PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun1->addText($row['auditfinding_no']);

		$cell1 = $table->addCell(4000, $cellRowSpan);
		$html = $row['auditfinding'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

		$cell1 = $table->addCell(2970, $cellRowSpan);
		$textrun1 = $cell1->addTextRun($cellHCentered);
		$html = $row['auditrecommend'];
		\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

		// $stage = form_001_audit_report::findOrFail($id);

		if ($stage == 1) {
			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(2300, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['istatus'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
		}else if ($stage == 2) {
			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fdate'])->format('F j, Y').'</b>'.$followup['fmanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fmmgtaction_date'])->format('F j, Y').'</b>'.$followup['fmonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(2300, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['fstatus'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
		}else if($stage == 3) {
			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fdate'])->format('F j, Y').'</b>'.$followup['fmanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['sdate'])->format('F j, Y').'</b>'.$followup['smanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fmmgtaction_date'])->format('F j, Y').'</b>'.$followup['fmonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['smmgtaction_date'])->format('F j, Y').'</b>'.$followup['smonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(2300, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['sstatus'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
		}else if ($stage == 'f'){
			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fdate'])->format('F j, Y').'</b>'.$followup['fmanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['sdate'])->format('F j, Y').'</b>'.$followup['smanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['tdate'])->format('F j, Y').'</b>'.$followup['tmanagement_action'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(3100, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['imonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['fmmgtaction_date'])->format('F j, Y').'</b>'.$followup['fmonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['smmgtaction_date'])->format('F j, Y').'</b>'.$followup['smonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
			$html = '<b>'.Carbon::parse($followup['tmmgtaction_date'])->format('F j, Y').'</b>'.$followup['tmonitoring_mgtaction'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			$cell1 = $table->addCell(2300, $cellRowSpan);
			$textrun1 = $cell1->addTextRun($cellHCentered);
			$html = $followup['tstatus'];
			\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
		}
		

      	}
      		$agencyId = form_001_audit_report::findOrFail($id);
      		$docName = agency_code($agencyId->agency_id);

      		if ($stage == 1) {
	      		$m_stage = ' 1st Follow-up Monitoring';
	      	}else if($stage == 2){
	      		$m_stage = ' 2nd Monitoring';
	      	}else if($stage == 3){
	      		$m_stage = ' 3rd Monitoring';
	      	}else if($stage == 'f'){
	      		$m_stage = ' Final Monitoring';
	      	}
	      	

		    	// \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

		\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		    try{
		        $objectWriter->save(storage_path($docName.$m_stage.' Audit Report.docx'));
		    } catch (Exception $e) {
		   
		    }
		 
		return response()->download(storage_path($docName.$m_stage.' Audit Report.docx'));
	}

	public function summaryReport($id, $stage){
    	$phpWord = new \PhpOffice\PhpWord\PhpWord();
    	$sectionStyle = array(
		    'orientation' => 'portrait',
		    'marginLeft' => 600,
		    'marginRight' => 900,
		    'marginTop' => 900,
		    'marginBottom' => 900

		);

		$tableStyle = array(
		    'borderColor' => '00000',
		    'borderSize'  => 1,
		    'cellMargin'  => 50000,
		    'cellMarginTop'=>80,
		  	'cellMarginLeft'=>80,
		  	'cellMarginRight'=>80,
		  	'cellMarginBottom'=>80

		);

		$headerStyle = array(
		    'headerHeight'  => 500
		);

		$firstPageHeader = array(
		    'spaceAfter'=>0,  
		    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,
		    'size'    => '8',
		);

		$tableStyleSummary = array(
		    'borderColor' => '00000',
		    'borderSize'  => 1,
		    'cellMargin'  => 50000,
		    'cellMarginTop'=>10,
			  'cellMarginLeft'=>100,
			  'cellMarginRight'=>100,
			  'cellMarginBottom'=>10,


		);


		$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center' );
		$cellAuditCon = array('vMerge' => 'restart');
		$cellVlign = array('valign' => 'center' );
		$cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH);
		$cellHeaderCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$cellVCentered = array('valign' => 'center');
		$cellRowRestart = array('vMerge' => 'continue');
		$cellColSpan = array('gridSpan' => 2);

		
    	$section = $phpWord->addSection($sectionStyle);

    	$agencyId = form_001_audit_report::findOrFail($id);
      	$docName = agency_code($agencyId->agency_id);

		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('Department of Science and Technology', array('size'=>'11')); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('INTERNAL AUDIT SERVICE', array('size'=>'11')); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText(' ', array('size'=>'11')); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('Status of Unaddressed/Unimplemented '.$docName. ' Internal Audit Findings/Observations and Recommendations', array('size'=>'11')); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
		$textrun->addText('As of ', array('size'=>'11')); 
		$textrun = $section->addTextRun(array('spaceAfter'=>0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

		$tableH = $section->addTable($tableStyle);
		$tableH->addRow(870);

		$cell1 = $tableH->addCell(600);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('IAF No.');

		$cell1 = $tableH->addCell(3100);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Remaining Unaddressed Audit Areas');

		$cell1 = $tableH->addCell(4800);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Recommended Corrective Action');

		$cell1 = $tableH->addCell(3100);
		$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
		$textrun1->addText('Status');

		$ivals = managementAction::where('form_001_id', $id)->where('istatus', 'LIKE', '%OPEN%')->get();
		$fvals = managementAction::where('form_001_id', $id)->where('fstatus', 'LIKE', '%OPEN%')->get();
		$svals = managementAction::where('form_001_id', $id)->where('sstatus', 'LIKE', '%OPEN%')->get();
		$tvals = managementAction::where('form_001_id', $id)->where('tstatus', 'LIKE', '%OPEN%')->get();
		$table = $section->addTable($tableStyleSummary);

		$cellColSpan = array('gridSpan' => 4);

		$previousValue = ' ';
		$previousValue1 = ' ';

		if ($stage == 1) {
			foreach ($ivals as $val) {
				$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $val['auditfinding_no'])->first();

				$a_area = $auditarea['audit_area'];
				$c_area = $auditarea['custom_auditarea'];

				if($previousValue != $a_area) {
				 	$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['audit_area'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue = $a_area;
				}elseif ($previousValue1 != $c_area) {
					$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue1 = $c_area;
				}else{
					
				}
				
			
				$table->addRow(500);
				$cell1 = $table->addCell(600);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
				$html = $val['auditfinding_no'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $auditarea['custom_auditarea'];
				$html = $auditarea['sub_auditarea'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(4800);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $val['imonitoring_mgtaction'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered);
				$html = $val['istatus'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			}
		} else if($stage == 2){
			foreach ($fvals as $val) {
				$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $val['auditfinding_no'])->first();

				$a_area = $auditarea['audit_area'];
				$c_area = $auditarea['custom_auditarea'];

				if($previousValue != $a_area) {
				 	$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['audit_area'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue = $a_area;
				}elseif ($previousValue1 != $c_area) {
					$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue1 = $c_area;
				}else{
					
				}
				
				$previousValue = $a_area;

				$table->addRow(500);
				$cell1 = $table->addCell(600);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
				$html = $val['auditfinding_no'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $auditarea['custom_auditarea'];
				$html = $auditarea['sub_auditarea'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(4800);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $val['imonitoring_mgtaction'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered);
				$html = $val['fstatus'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			}
		} else if($stage == 3){
			foreach ($svals as $val) {
				$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $val['auditfinding_no'])->first();

				$a_area = $auditarea['audit_area'];
				$c_area = $auditarea['custom_auditarea'];

				if($previousValue != $a_area) {
				 	$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['audit_area'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue = $a_area;
				}elseif ($previousValue1 != $c_area) {
					$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue1 = $c_area;
				}else{
					
				}
				
				$previousValue = $a_area;

				$table->addRow(500);
				$cell1 = $table->addCell(600);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
				$html = $val['auditfinding_no'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $auditarea['custom_auditarea'];
				$html = $auditarea['sub_auditarea'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(4800);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $val['imonitoring_mgtaction'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered);
				$html = $val['sstatus'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			}
		} else if($stage == 'f'){
			foreach ($tvals as $val) {
				$auditarea = formcontent::where('form_001_id', $id)->where('auditfinding_no', $val['auditfinding_no'])->first();

				$a_area = $auditarea['audit_area'];
				$c_area = $auditarea['custom_auditarea'];

				if($previousValue != $a_area) {
				 	$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['audit_area'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue = $a_area;
				}elseif ($previousValue1 != $c_area) {
					$table->addRow(300);
					$cell1 = $table->addCell(4000, $cellColSpan);
					$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
					$html = '<b>'.$auditarea['custom_auditarea'].'</b>';
					\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);
					$previousValue1 = $c_area;
				}else{
					
				}
				
				$previousValue = $a_area;

				$table->addRow(500);
				$cell1 = $table->addCell(600);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered, array('textAlignment' => \PhpOffice\PhpWord\SimpleType\TextAlignment::TOP));
				$html = $val['auditfinding_no'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $auditarea['custom_auditarea'];
				$html = $auditarea['sub_auditarea'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(4800);
				$textrun1 = $cell1->addTextRun(array('spaceAfter'=>0));
				$html = $val['imonitoring_mgtaction'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

				$cell1 = $table->addCell(3100);
				$textrun1 = $cell1->addTextRun($cellHeaderCentered);
				$html = $val['tstatus'];
				\PhpOffice\PhpWord\Shared\Html::addHtml($cell1, $html);

			}
		}
			
		
		
      	if ($stage == 1) {
      		$m_stage = ' 1st Monitoring';
      	}else if($stage == 2){
      		$m_stage = ' 2nd Monitoring';
      	}else if($stage == 3){
      		$m_stage = ' 3rd Monitoring';
      	}else if($stage == 'f'){
      		$m_stage = ' Final Monitoring';
      	}
      	

		    	// \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

		\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		    try{
		        $objectWriter->save(storage_path($docName.$m_stage.' Summary of Unaddressed Findings.docx'));
		    } catch (Exception $e) {
		   
		    }
		 
		return response()->download(storage_path($docName.$m_stage.' Summary of Unaddressed Findings.docx'));
	}

}
