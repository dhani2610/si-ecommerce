@extends('layouts-fe.app')

@section('style')
<style>
.btn-shop-all{
    color: black;
    background: white;
    border: 2px solid black;
    width: 9em;
    height: 3em;
    font-weight:800;
}

.card-img-top{
    max-width: fit-content!important;
}

</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endsection
@section('content')
     <!-- ======= About Section ======= -->
     <section id="about" class="about">
        <div class="container">
  
            <div class="row content">
                <h2 class="" style="font-size: 25px">History Order</h2>
                <div class="col-lg-12">
                <div class="table-responsive p-0">
                    <table id="myDataTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    NO
                                </th>
                          
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Phone Number
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Address
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Order Date
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Product
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Shipping
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Payment Photo
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $item)
                            <tr>
                                    
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                </td>
                                
                                <td class="text-center">
                                    {{ $item->name }}
                                </td>
                                
                                <td class="text-center">
                                    {{ $item->phone_number }}
                                </td>
                                <td class="text-center">
                                    {{ $item->address }}
                                </td>
                                <td class="text-center">
                                    {{ $item->created_at }}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showProduct{{ $item->id }}">Show</button>
                                                              
                                    <!-- Modal -->
                                    <div class="modal fade" id="showProduct{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="myDataTableProduct" class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="" style="font-size: 15px">
                                                            NO
                                                        </th>
                                                        <th class="text-center " style="font-size: 15px">
                                                            Image
                                                        </th>
                                                        <th class="text-center " style="font-size: 15px">
                                                            Product Name
                                                        </th>
                                                        <th class="text-center " style="font-size: 15px">
                                                            Qty
                                                        </th>
                                                        <th class="text-center " style="font-size: 15px">
                                                            Price
                                                        </th>
                                                        <th class="text-center " style="font-size: 15px">
                                                            Total
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $checkoutDetail = \App\Models\CheckoutDetail::where('id_checkout',$item->id)->get();
                                                    @endphp
                                                    @foreach ($checkoutDetail as $cd)
                                                    <tr>
                                                        @php
                                                            $prod = \App\Models\Product::where('id',$cd->id_product)->first();
                                                        @endphp
                                                            
                                                        <td class="ps-4">
                                                            <p class=""style="font-size: 15px">{{ $loop->iteration }}</p>
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset('assets/img/foto_product/'.$prod->foto_1) }}" alt="" style="max-width: 200px">
                                                        </td>
                                                        <td class="text-center">
                                                            <p class=""style="font-size: 15px">{{ $prod->nama ?? '-' }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class=""style="font-size: 15px">{{ $cd->qty }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class=""style="font-size: 15px">@currency($prod->harga ?? 0)</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class=""style="font-size: 15px">@currency($prod->harga * $cd->qty)</p>
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
  
                                </td>
                                <td class="text-center">
                                    {{ $item->shipping == 1 ? 'Di Antar Kurir' : 'Ambil Di Toko' }}
                                </td>
                                <td class="text-center">
                                    @currency($item->total)
                                </td>
                                <td>
                                    <a href="{{ asset('assets/img/foto_bukti_pembayaran/'.$item->bukti_pembayaran) }}" target="_blank">View Photo</a>
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 1)
                                        <span class="badge badge-warning bg-warning">Waiting Validation Payment</span>
                                    @elseif ($item->status == 2)
                                        <span class="badge badge-warning" style="background:silver">Order in process</span>
                                    @elseif ($item->status == 3)
                                        <span class="badge badge-warning" style="background:orange">Order sent</span>
                                    @elseif ($item->status == 4)
                                        <span class="badge badge-success bg-success">Order Completed</span>
                                    @elseif ($item->status == 5)
                                        <span class="badge badge-danger bg-danger">Order Rejected</span>
                                    @endif
                                </td>
                                
                               
                            </tr>
                        @endforeach

                       

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
  
        </div>
      </section><!-- End About Section -->
  
    

@endsection
@section('script')
     

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myDataTable').DataTable();
        $('#myDataTableProduct').DataTable();

    });
</script>
@endsection