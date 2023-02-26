<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $coupons = Coupon::latest('id')->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CouponRequest $request)
    {
        Coupon::create([
            'name' => '',
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'usage' => $request->usage,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admin.coupons.index')->with('msg', 'Coupon created successfullly')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Coupon
     */
    public function show(Coupon $coupon)
    {
        return $coupon;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Coupon
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        Coupon::update([
            'name' =>  '',
            'code' =>  $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'usage' => $request->usage,
            'product_id' => $request->product_id,
        ]);

        return $coupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('msg', 'Coupon deleted successfullly')->with('type', 'danger');
    }
}
