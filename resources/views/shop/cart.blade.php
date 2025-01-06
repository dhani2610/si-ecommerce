@extends('layouts-fe.app')

@section('style')
<style>
#cart {
  max-width: 1440px;
  padding-top: 60px;
  margin: auto;
}
.form div {
  margin-bottom: 0.4em;
}
.cartItem {
  --bs-gutter-x: 1.5rem;
}
.cartItemQuantity,
.proceed {
  background: #f4f4f4;
}
.items {
  padding-right: 30px;
}
#btn-checkout {
  min-width: 100%;
}

/* stasysiia.com */
/* @import url("https://fonts.googleapis.com/css2?family=Exo&display=swap"); */
body {
  background-color: #fff;
  font-family: "Exo", sans-serif;
  font-size: 22px;
  margin: 0;
  padding: 0;
  color: #111111;
  justify-content: center;
  align-items: center;
}
a {
  color: #0e1111;
  text-decoration: none;
}
.btn-check:focus + .btn-primary,
.btn-primary:focus {
  color: #fff;
  background-color: #111;
  border-color: transparent;
  box-shadow: 0 0 0 0.25rem rgb(49 132 253 / 50%);
}
button:hover,
.btn:hover {
  box-shadow: 5px 5px 7px #c8c8c8, -5px -5px 7px white;
}
button:active {
  box-shadow: 2px 2px 2px #c8c8c8, -2px -2px 2px white;
}

/*PREVENT BROWSER SELECTION*/
a:focus,
button:focus,
input:focus,
textarea:focus {
  outline: none;
}
/*main*/
main:before {
  content: "";
  display: block;
  height: 88px;
}
h1 {
  font-size: 2.4em;
  font-weight: 600;
  letter-spacing: 0.15rem;
  text-align: center;
  margin: 30px 6px;
}
h2 {
  color: rgb(37, 44, 54);
  font-weight: 700;
  font-size: 2.5em;
}
h3 {
  border-bottom: solid 2px #000;
}
h5 {
  padding: 0;
  font-weight: bold;
  color: #92afcc;
}
p {
  color: #333;
  font-family: "Roboto", sans-serif;
  margin: 0.6em 0;
}
h1,
h2,
h4 {
  text-align: center;
  padding-top: 16px;
}
/* yukito bloody */
.back {
  position: relative;
  top: -30px;
  font-size: 16px;
  margin: 10px 10px 3px 15px;
}
.inline {
  display: inline-block;
}

.shopnow,
.contact {
  background-color: #000;
  padding: 10px 20px;
  font-size: 10px;
  color: white;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.5s;
  cursor: pointer;
}
.shopnow:hover {
  text-decoration: none;
  color: white;
  background-color: #c41505;
}
/* for button animation*/
.shopnow span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: all 0.5s;
}
.shopnow span:after {
  content: url("https://badux.co/smc/codepen/caticon.png");
  position: absolute;
  font-size: 20px;
  opacity: 0;
  top: 2px;
  right: -6px;
  transition: all 0.5s;
}
.shopnow:hover span {
  padding-right: 25px;
}
.shopnow:hover span:after {
  opacity: 1;
  top: 2px;
  right: -6px;
}
.ma {
  margin: auto;
}
.price {
  color: slategrey;
  font-size: 2em;
}
#mycart {
  min-width: 90px;
}
#cartItems {
  font-size: 17px;
}
#product .container .row .pr4 {
  padding-right: 15px;
}
#product .container .row .pl4 {
  padding-left: 15px;
}

.section {
    padding: 0px!important
}


</style>
@endsection
@section('content')
     <!-- ======= About Section ======= -->
     <section id="about" class="about" style="padding: 0px!important">
         <div class="container">
             <div class="container-fluid">
                @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                        {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                @if(session('failed'))
                    <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
                        <span class="alert-text text-white">
                        {{ session('failed') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                <label style="color: black;font-weight:700;">Your cart</label> <br>
                <label style="color: black;font-weight:700;font-size:15px">Not ready to checkout? Continue Shopping</label>
                <br>
                <div class="row align-items-start">
                  <div class="col-12 col-sm-8 items">
                    <!--1-->
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($cart as $ct)
                    <div class="cartItem row align-items-start">
                      @php
                          $product = \App\Models\Product::where('id',$ct->id_product)->first();
                      @endphp
                      <div class="col-3 mb-2">
                        <img class="w-100" src="{{ asset('assets/img/foto_product/'.$product->foto_1 ?? '-') }}" alt="art image">
                      </div>
                      <div class="col-5 mb-2">
                        <label style="color: black;font-weight:700;">{{ $product->nama ?? '-' }}</label> <br>
                        <p class="pl-1 mb-0" style="font-size: 14px">Quantity : {{ $ct->qty }}</p>
                        <p class="pl-1 mb-0" style="font-size: 16px;font-weight:700">@currency($product->harga * $ct->qty)</p>
                        @php
                            $subtotal += $product->harga * $ct->qty;
                        @endphp
                      </div>
                      <div class="col-2">
                        <p class="pl-1 mb-0" style="font-size: 14px">Stok : {{ $product->stok }}</p>
                        <a href="{{ route('removeCart',$ct->id) }}">
                            <p class="pl-1 mb-0" style="font-size: 14px"> <u>Remove</u> </p>
                        </a>
                      </div>
                    </div>
                    <hr>
                    @endforeach
                  </div>
                  <div class="col-12 col-sm-4 p-3 proceed form">
                      <p class="pl-1 mb-2" style="font-size: 18px;font-weight:800;">Order Summary</p>
                    <div class="row m-0">
                      <div class="col-sm-4 p-0">
                        <h6>Subtotal</h6>
                      </div>
                      <div class="col-sm-8 p-0">
                        <h6 style="float: right">@currency($subtotal)</h6>
                      </div>
                    </div>
                    <div class="row m-0">
                      <div class="col-sm-4 p-0 ">
                        <h6>Shipping</h6>
                      </div>
                      <div class="col-sm-8 p-0">
                        <h6 style="float: right"> Calculated at the next step</h6>
                      </div>
                    </div>
                    <hr>
                    <div class="row mx-0 mb-2">
                      <div class="col-sm-8 p-0 d-inline">
                        <h6>Total</h6>
                      </div>
                      <div class="col-sm-4 p-0">
                        <h6 style="float: right">@currency($subtotal)</h6>
                      </div>
                    </div>
                    <a href="{{ route('checkout') }}"><button id="btn-checkout" class="shopnow"><span>Continue to checkout</span></button></a>
                  </div>
                </div>
              </div>
              </div>
  
        </div>
      </section><!-- End About Section -->
  

@endsection
@section('script')
    
@endsection