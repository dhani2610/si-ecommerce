<?php

namespace App\Http\Controllers;

use App\Models\PriceShipping;
use Illuminate\Http\Request;

class PriceShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Price Shipping';
        $data['price'] = PriceShipping::orderBy('id','desc')->get();
		return view('price_shipping.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new PriceShipping();
            $data->price_shipping = $request->price_shipping;
            $data->save();
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed created');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(PriceShipping $priceShipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceShipping $priceShipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = PriceShipping::find($id);
            $data->price_shipping = $request->price_shipping;
            $data->save();
             return redirect()->back()->with('success','Data has been updated');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = PriceShipping::find($id);
            $data->delete();
             return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}
