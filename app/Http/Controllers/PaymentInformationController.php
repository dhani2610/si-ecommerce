<?php

namespace App\Http\Controllers;

use App\Models\PaymentInformation;
use Illuminate\Http\Request;

class PaymentInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Payment Information';
        $data['payment'] = PaymentInformation::orderBy('id','desc')->get();
		return view('payment_information.index',$data);
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
            $data = new PaymentInformation();
            $data->nama = $request->nama;
            $data->no_payment = $request->no_payment;
            $data->deskripsi = $request->deskripsi;
            $data->save();
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed created');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentInformation $paymentInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentInformation $paymentInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = PaymentInformation::find($id);
            $data->nama = $request->nama;
            $data->no_payment = $request->no_payment;
            $data->deskripsi = $request->deskripsi;
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
            $data = PaymentInformation::find($id);
            $data->delete();
             return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}
