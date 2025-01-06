<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use App\Models\Cart;
use App\Models\Category;
use App\Models\checkout;
use App\Models\CheckoutDetail;
use App\Models\PaymentInformation;
use App\Models\PriceShipping;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(Request $request){
        $data['page_title'] = 'Dashboard';
        $tahunReq = $request->tahun;
        if ($tahunReq == null) {
            $tahunReq = date('Y');
        }

        $data['product_count'] = Product::count();

        // Apply year filter if $tahunReq is not null
        $data['order_incoming'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 1)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->get();

        $data['inProcess'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 2)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->get();

        $data['orderSent'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 3)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->get();

        $data['orderCompleted'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 4)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->get();

        $data['orderRejected'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 5)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->get();

        // Calculate income for the completed orders with the year filter if provided
        $data['income'] = Checkout::orderBy('created_at', 'desc')
            ->where('status', 4)
            ->when($tahunReq, function ($query, $tahunReq) {
                return $query->whereYear('created_at', $tahunReq);
            })
            ->sum('total');
        // CHART 

        if ($tahunReq != null) {
           $tahun = $tahunReq;
        }else{
            $tahun = date('Y');
        }

        $data['charts_income'] = [];
        $bulan = range(1,12);
        foreach ($bulan as $key => $value) {
            $incomeMasuk = checkout::whereYear('created_at',$tahun)->whereMonth('created_at',$value)->orderBy('created_at','desc')->where('status',4)->get()->sum('total');
            array_push($data['charts_income'], $incomeMasuk);
        }

        $data['tahun'] = $tahun;

		return view('dashboard',$data);
    }

    public function home(Request $request){
        $data['page_title'] = 'Home';
        $data['category'] = Category::orderBy('id','desc')->get();
        $data['product'] = Product::orderBy('id','desc')->limit(3)->get();
		return view('shop.home',$data);
    }
    public function shop(Request $request){
        $data['page_title'] = 'Shop';
        $data['category'] = Category::orderBy('id','desc')->get();
        $data['product'] = Product::orderBy('id','desc')->get();
		return view('shop.shop',$data);
    }
    public function detail($id){
        $data['page_title'] = 'Shop';
        $data['product'] = Product::find($id);
		return view('shop.detail',$data);
    }

    public function filter(Request $request){
        $categories = $request->input('categories', []);
        
        if (!empty($categories)) {
            $products = Product::whereIn('id_category', $categories)->orderBy('id', 'desc')->get();
        } else {
            $products = Product::orderBy('id', 'desc')->get();
        }
    
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => number_format($product->harga, 2),
                'foto_1' => asset('assets/img/foto_product/'.$product->foto_1),
            ];
        });
    
        return response()->json(['products' => $products]);
    }

    public function addtocart(Request $request,$id){
        try {
            if (Auth::check() == null) {
                return redirect('/login');
            }

            $cek = Cart::where('id_product',$id)->where('id_user',Auth::user()->id)->first();
            $product = Product::find($id);

            if ($request->quantity > $product->stok) {
                return redirect()->back()->with('failed','Insufficient product stock!');
            }
            if ($cek != null) {
                $update = Cart::find($id);
                $old_qty = $update->qty;
                $update->qty = $old_qty + $request->quantity;
                $update->save();
            }else{
                $new = new Cart();
                $new->id_product = $id;
                $new->qty = $request->quantity;
                $new->id_user = Auth::user()->id;
                $new->save();
            }
            return redirect()->back()->with('success','Add To Cart Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed','Failed Add To Cart');
        }
    }
    public function cart(){
        if (Auth::check() == null) {
            return redirect('/login');
        }
        $data['page_title'] = 'Cart';
        $data['cart'] = Cart::orderBy('id','desc')->where('id_user',Auth::user()->id)->get();
		return view('shop.cart',$data);
    }

    public function removeCart($id){
        try {
            $data = Cart::where('id',$id)->where('id_user',Auth::user()->id)->first();
            $data->delete();
            
            return redirect()->back()->with('success','Remove Item Cart Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed','Failed Remove item Cart!');
        }
    }

    public function checkout(){
        if (Auth::check() == null) {
            return redirect('/login');
        }
        $data['page_title'] = 'Checkout';
        $data['cart'] = Cart::orderBy('id','desc')->where('id_user',Auth::user()->id)->get();
        $data['payment'] = PaymentInformation::orderBy('id','desc')->get();
        $data['shipping'] = PriceShipping::first();
		return view('shop.checkout',$data);
    }

    public function prosesCheckout(Request $request){
        // dd($request->all());
       try {
            $checkout = new checkout();
            $checkout->id_user = Auth::user()->id;
            $checkout->total = $request->total;
            $checkout->shipping = $request->shipping;
            $checkout->name = $request->name;
            $checkout->address = $request->address;
            $checkout->status = 1;
            $checkout->phone_number = $request->phone_number;
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/foto_bukti_pembayaran/');
                $image->move($destinationPath, $name);
                $checkout->bukti_pembayaran = $name;
            }
            if ($checkout->save()) {
                $cart = Cart::whereIn('id',$request->id_cart)->get();
                foreach ($cart as $ct) {
                    $checkoutDetail = new CheckoutDetail();
                    $checkoutDetail->id_checkout = $checkout->id;
                    $prod = Product::find($ct->id_product);
                    $checkoutDetail->id_product = $prod->id;
                    $checkoutDetail->qty = $ct->qty;
                    $checkoutDetail->harga = $prod->harga;
                    $checkoutDetail->total = $prod->harga * $ct->qty;
                    if ($checkoutDetail->save()) {
                        $stokOld = $prod->stok;
                        $prod->stok = $stokOld - $ct->qty;
                        $prod->save();
                    }
                    
                }
            }

            return redirect('cart')->with('success','Checkout Success!');
        } catch (\Throwable $th) {
           return redirect()->back()->with('failed','Checkout Failed!');
       }
    }

    public function history(){
        if (Auth::check() == null) {
            return redirect('/login');
        }
        $data['page_title'] = 'History Order';
        $data['history'] = checkout::orderBy('created_at','desc')->where('id_user',Auth::user()->id)->get();
		return view('shop.history',$data);
    }
   
}
