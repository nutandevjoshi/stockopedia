<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Responses\BaseResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new BaseResponse())->successWithData("data_fetched",['result'=>Plan::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // check what should be done after we get the data
        return (new BaseResponse())->successWithData("data_fetched",['result'=>Plan::find($id)]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function calculateCost(PlanRequest $request)
    {
        $input = $request->validated()['filters'];

        $planIds = collect($input)->pluck('plan_id')->toArray();
        $plans = Plan::whereIn('id', $planIds)->get()->keyBy('id')->toArray();
        // Calculate cost
        $cost = 0;
        foreach($input as $record) {
            $planId = $record['plan_id'];
            $planDetails = isset($plans[$planId])?$plans[$planId] : [];
            if($planDetails) {
                $cost+= $record['frequency'] == 'monthly' ? $planDetails['monthly_cost'] : $planDetails['annual_cost'];
            }
        }
        // if he selects monthly frequency, he will have to pay now 1 month fee only so calculating accordingly.
        return (new BaseResponse())->successWithData("data_fetched",['cost'=>$cost]);
    }
}
