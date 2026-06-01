<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon(Request $request)
    {
        try {
            $value=$request->coupon;
            $coupon=Coupon::where('code',$value)->first();
            if($coupon){
                if($coupon->active==true){
                    return response()->json([
                        'message'=>'Coupon Added Successfully!',
                        'coupon_value'=>$coupon->value,
                        'coupon_type'=>$coupon->discount_type
                ]);
                }else{
                    return response()->json([
                        'error' => "Coupon Expired",
                    ], 500);
                }
            }else{
                return response()->json([
                    'error' => "No Coupon",
                ], 500);
            }

        } catch (Exception $exception) {
            report($exception);
            return response()->json([
                'm' => $exception->getMessage(),
                'error' => __('main.unexpected-error')
            ], 500);
        }
    }

}
