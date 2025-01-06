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

.input-ck{
    border-radius: 0px;
    padding: 10px;
    border: 1px solid black;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('content')
<form action="{{ route('proses-checkout') }}" method="post" enctype="multipart/form-data">
  @csrf
     <!-- ======= About Section ======= -->
     <section id="about" class="about" style="padding: 0px!important">
         <div class="container">
             <div class="container-fluid">
                <label style="color: black;font-weight:700;">Checkout</label> <br>
                <label style="color: black;font-weight:700;font-size:15px">Address <i class="fa fa-long-arrow-alt-right"></i> Shipping <i class="fa fa-long-arrow-alt-right"></i> Payment</label>
                <br>
                <br>
                <label style="color: black;">Shipping Information </label> <br>
                <div class="row align-items-start">
                  <div class="col-12 col-sm-6 items">
                    <div class="form-group mt-2">
                      <input type="text" class="form-control input-ck" value="{{ Auth::user()->name }}" name="name" placeholder=" Full Name">
                    </div>
                    <div class="form-group mt-2">
                      <input type="text" class="form-control input-ck" value="{{ Auth::user()->location }}" name="address" placeholder="Address">
                    </div>
                    <div class="form-group mt-2">
                      <input type="text" class="form-control input-ck" value="{{ Auth::user()->phone }}" name="phone_number" placeholder="Phone Number">
                    </div>
                    <br>
                    <button type="button" id="btn-checkout" class="shopnow" style="height: 5em" data-bs-toggle="modal" data-bs-target="#showInformation"><span>Show Payment Information</span></button>
                                        
                    <!-- Modal -->
                    <div class="modal fade" id="showInformation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <table id="myDataTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="" style="font-size: 15px">
                                            NO
                                        </th>
                                        <th class="text-center " style="font-size: 15px">
                                            Name
                                        </th>
                                        <th class="text-center " style="font-size: 15px">
                                            No Rekening/Wallet
                                        </th>
                                        <th class="text-center " style="font-size: 15px">
                                            Description
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $item)
                                    <tr>
                                            
                                        <td class="ps-4">
                                            <p class=""style="font-size: 15px">{{ $loop->iteration }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class=""style="font-size: 15px">{{ $item->nama }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class=""style="font-size: 15px">{{ $item->no_payment }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class=""style="font-size: 15px">{{ $item->deskripsi }}</p>
                                        </td>
                                    </tr>
                                @endforeach
    
                              
    
                                </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="form-group mt-2">
                      <input type="file" class="form-control input-ck" accept="image/*" name="file" placeholder="Upload File Payment">
                      <small style="color: red;font-size:10px">*Only Image</small>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 p-3 proceed form">
                      <p class="pl-1 mb-2" style="font-size: 18px;font-weight:800;">Your cart</p>
                    <div class="row m-0">
                      <div class="col-lg-12">
                          @php
                            $subtotal = 0;
                          @endphp
                          @foreach ($cart as $ct)
                          <input type="hidden" name="id_cart[]" value="{{ $ct->id }}">
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
                            <div class="col-4">
                              <p class="pl-1 mb-0" style="font-size: 14px">Stok : {{ $product->stok }}</p>
                              <a href="{{ route('removeCart',$ct->id) }}">
                                  <p class="pl-1 mb-0" style="font-size: 14px"> <u>Remove</u> </p>
                              </a>
                            </div>
                          </div>
                          <hr>
                          @endforeach
                      </div>
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
                            <input type="checkbox" id="pickup" name="shipping" value="1">
                            <label for="courier" style="font-size: 14px">Di Antar Kurir</label> <br>
                            <input type="checkbox" id="courier" name="shipping" value="0" checked>
                            <label for="pickup" style="font-size: 14px">Ambil Di Toko</label> <br>
                        </div>
                        <div class="col-sm-8 p-0">
                            <h6 style="float: right" class="shipping">Free</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row mx-0 mb-2">
                        <div class="col-sm-8 p-0 d-inline">
                            <h6>Total</h6>
                        </div>
                        <div class="col-sm-4 p-0">
                            <h6 style="float: right" class="total">@currency($subtotal)</h6>
                        </div>
                    </div>
                    <input type="hidden" name="total" class="total-all" value="{{ $subtotal }}">
                    <a href=""><button id="btn-checkout" class="shopnow"><span>checkout</span></button></a>
                  </div>
                </div>
              </div>
              </div>
  
        </div>
      </section><!-- End About Section -->
</form>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  const pickupCheckbox = document.getElementById('pickup');
  const courierCheckbox = document.getElementById('courier');
  const shippingElement = document.querySelector('.shipping');
  const totalElement = document.querySelector('.total');

  const shippingCost = {{ $shipping->price_shipping }};
  let subtotal = {{ $subtotal }}; // Ganti dengan nilai subtotal sebenarnya

  function updateShipping() {
      if (pickupCheckbox.checked) {
          shippingElement.textContent = `Rp. ${shippingCost.toLocaleString()}`;
      } else {
          shippingElement.textContent = 'Free';
      }
      console.log(shippingCost);
      updateTotal(shippingCost);
  }

  function updateTotal(shippingCost) {
      let total = subtotal;
      if (pickupCheckbox.checked) {
          total += shippingCost;
      }
      $('.total-all').val(total);
      totalElement.textContent = `Rp. ${total.toLocaleString()}`;
  }

  pickupCheckbox.addEventListener('change', () => {
      courierCheckbox.checked = !pickupCheckbox.checked;
      updateShipping();
  });

  courierCheckbox.addEventListener('change', () => {
      pickupCheckbox.checked = !courierCheckbox.checked;
      updateShipping();
  });

  // Initialize
  updateShipping();
</script>
    
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
@endsection