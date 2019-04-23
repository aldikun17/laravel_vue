<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\referral;

use App\Http\Controllers\Web\ExcelImports;

use PDF;

use Excel;

class ReferraReturnController extends Controller
{

	protected function referral($cat,$id)
    {

        return referral::where('category',$cat)->where('control_code',$id)->first();

    }
    
	public function delete_referral( $category , $control_code)
	{


		$referral_id = $this->referral($category,$control_code);

		$delete_referral = referral::findorFail($referral_id->id);

		$delete_referral->delete();

		return $category.' '.$control_code .' has been successfully deleted';

	}

	public function referral_search($cat,$control_code)
	{

		return referral::where('category',$cat)->where('control_code',$control_code)->get();

	}

	public function pdf_referral($cat,$control_code)
	{

		$referral = referral::where('category',$cat)->where('control_code',$control_code)->first();

		$customPaper = array(0,0,900,1500);

		return $pdf = PDF::loadView('web.report_pdf',compact('referral'))->setPaper($customPaper)->stream($referral['category'].' '.$referral['control_code']);

	}

	public function excel_referral($category)
	{

		$importexcel = new ExcelImports($category);

		$importexcel->query();

		return (new ExcelImports($category))->download($category.'.xlsx');

	}

}
