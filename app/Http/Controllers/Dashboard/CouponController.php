<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\DataTables\CouponDataTable;

class CouponController extends Controller
{

    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('dashboard.coupons.index');
    }


    public function create()
    {
        return view('dashboard.coupons.create');
    }


    public function store(CouponRequest $request)
    {
        Coupon::create($request->getSanitized());
        session()->flash('message', 'Coupon Created Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function show(Coupon $coupon)
    {
        //
    }


    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit', compact('coupon'));
    }


    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->getSanitized());
        session()->flash('message', 'Coupon Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json([
            'message' => 'Coupon Deleted Successfully!'
        ]);
    }
}
