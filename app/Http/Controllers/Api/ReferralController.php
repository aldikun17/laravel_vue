<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\referral;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return referral::oldest()->paginate(10);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function referral($cat,$id)
    {

        return referral::where('category',$cat)->where('control_code',$id)->first();

    }

    protected function referral_last($cat,$id)
    {

        return referral::where('category',$cat)->orderBy('control_code','desc')->first();

    }

    public function store(Request $request)
    {

        $this->validate($request,[

            'correspondense_no' => 'required',

            'control_code'   => 'required|numeric',

            'from'           => 'required',

            'subject'        => 'required'

        ]);

        if(empty($this->referral($request['correspondense_no'],$request['control_code']))):

            $referral                   = new referral;

            $referral->category         = $request['correspondense_no'];

            $referral->control_code     = $request['control_code'];

            $referral->subject          = $request['subject'];

            $referral->from             = $request['from'];

            $referral->note             = 'NULL';

            $referral->save();

            return response()->json(['success' => 'success']);

        else:

            $last_referrence = $this->referral_last($request['correspondense_no'],$request['control_code']);

            return response()->json([ 'message' => 'The last referral is '.$last_referrence['category'] .' '.$last_referrence['control_code'] ]);

        endif;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cat,$id)
    {

        $update_referral = referral::where('category',$cat)->where('control_code',$id)->first();

        return $update_referral;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_referral(Request $request,$cat,$id)
    {

        $referral_id = $this->referral($cat,$id)['id'];

        $update_referral                    = referral::findOrFail($referral_id);

        $update_referral->category         = $request['category'];

        $update_referral->control_code     = $request['control_code'];

        $update_referral->subject          = $request['subject'];

        $update_referral->from             = $request['from'];

        $update_referral->note             = $request['notes'];

        $update_referral->save();


    }

    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
