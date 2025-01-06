<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Product';
        $data['product'] = Product::orderBy('id','desc')->get();
        $data['category'] = Category::orderBy('id','desc')->get();
		return view('product.index',$data);
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
            $data = new Product();
            $data->id_category = $request->category_id;
            $data->nama = $request->nama;   
            $data->harga = $request->price;
            $data->stok = $request->stok;
            $data->deskripsi = $request->deskripsi;
            if ($request->hasFile('foto_1')) {
                $image = $request->file('foto_1');
                $name = time() . '.' . $image->getClientOriginalExtension().'-1';
                $destinationPath = public_path('assets/img/foto_product/');
                $image->move($destinationPath, $name);
                $data->foto_1 = $name;
            }
            if ($request->hasFile('foto_2')) {
                $image = $request->file('foto_2');
                $name = time() . '.' . $image->getClientOriginalExtension().'-2';
                $destinationPath = public_path('assets/img/foto_product/');
                $image->move($destinationPath, $name);
                $data->foto_2 = $name;
            }
            if ($request->hasFile('foto_3')) {
                $image = $request->file('foto_3');
                $name = time() . '.' . $image->getClientOriginalExtension().'-3';
                $destinationPath = public_path('assets/img/foto_product/');
                $image->move($destinationPath, $name);
                $data->foto_3 = $name;
            }
            if ($request->hasFile('foto_4')) {
                $image = $request->file('foto_4');
                $name = time() . '.' . $image->getClientOriginalExtension().'-4';
                $destinationPath = public_path('assets/img/foto_product/');
                $image->move($destinationPath, $name);
                $data->foto_4 = $name;
            }
            $data->save();
           
 
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed created');
         }
    }

    public function incomingOrder()
    {
        $data['page_title'] = 'Incoming Order';
        $data['history'] = checkout::orderBy('created_at','desc')->where('status',1)->get();
		return view('order.incoming',$data);
    }
    public function inProcess()
    {
        $data['page_title'] = 'Process Order';
        $data['history'] = checkout::orderBy('created_at','desc')->where('status',2)->get();
		return view('order.inprocess',$data);
    }
    public function orderSent()
    {
        $data['page_title'] = 'Order Sent';
        $data['history'] = checkout::orderBy('created_at','desc')->where('status',3)->get();
		return view('order.sent',$data);
    }
    public function orderCompleted()
    {
        $data['page_title'] = 'Order Completed';
        $data['history'] = checkout::orderBy('created_at','desc')->where('status',4)->get();
		return view('order.completed',$data);
    }
    public function orderRejected()
    {
        $data['page_title'] = 'Order Rejected';
        $data['history'] = checkout::orderBy('created_at','desc')->where('status',5)->get();
		return view('order.rejected',$data);
    }

   
    public function updateStatus($id,$status)
    {
        try {
            $history = checkout::find($id);
            if ($status == 2) {
                $history->status = $history->shipping == 1 ? 2 : 4;
            }else{
                $history->status = $status;
            }
            $history->save();

            return redirect()->back()->with('success','Success Updated Data!');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Failed Updated Data!');
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Product::find($id);
            $data->id_category = $request->category_id;
            $data->nama = $request->nama;   
            $data->harga = $request->price;
            $data->stok = $request->stok;
            $data->deskripsi = $request->deskripsi;
            if ($request->hasFile('foto_1')) {
                $image1 = $request->file('foto_1');
                $name1 = time() . '.' . $image1->getClientOriginalExtension().'-1';
                $destinationPath1 = public_path('assets/img/foto_product/');
                $image1->move($destinationPath1, $name1);
                $data->foto_1 = $name1;
            }
            if ($request->hasFile('foto_2')) {
                $image2 = $request->file('foto_2');
                $name2 = time() . '.' . $image2->getClientOriginalExtension().'-2';
                $destinationPath2 = public_path('assets/img/foto_product/');
                $image2->move($destinationPath2, $name2);
                $data->foto_2 = $name2;
            }
            if ($request->hasFile('foto_3')) {
                $image3 = $request->file('foto_3');
                $name3 = time() . '.' . $image3->getClientOriginalExtension().'-3';
                $destinationPath3 = public_path('assets/img/foto_product/');
                $image3->move($destinationPath3, $name3);
                $data->foto_3 = $name3;
            }
            if ($request->hasFile('foto_4')) {
                $image4 = $request->file('foto_4');
                $name4 = time() . '.' . $image4->getClientOriginalExtension().'-4';
                $destinationPath4 = public_path('assets/img/foto_product/');
                $image4->move($destinationPath4, $name4);
                $data->foto_4 = $name4;
            }
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
            $data = Product::find($id);
            $data->delete();
           
 
             return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}
