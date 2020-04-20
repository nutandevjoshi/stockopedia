<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\UserPlan;
use App\Responses\BaseResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library

class UserController extends Controller
{

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function savePlans(PlanRequest $request)
    {
        $token = JWTAuth::getToken();
        $apy = JWTAuth::getPayload($token)->toArray();
        $userId =$apy['sub'];

        $input = $request->validated()['filters'];
        $planIds = collect($input)->pluck('plan_id')->toArray();
        $plans = Plan::whereIn('id', $planIds)->get()->keyBy('id')->toArray();
        // Calculate cost
        $cost = 0;
        foreach($input as $record) {
            $planId = $record['plan_id'];
            $planDetails = isset($plans[$planId])?$plans[$planId] : [];
            if($planDetails) {
                $dataToSave = [
                    'plan_id' => $planId,
                    'user_id' => $userId,
                    'frequency' => $record['frequency'],
                ];
                UserPlan::create($dataToSave);
            }
        }
        return (new BaseResponse())->successWithData("data_added",['success'=>true]);
    }
}
