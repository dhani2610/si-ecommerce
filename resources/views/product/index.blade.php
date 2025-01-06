@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<div>
 
    @if($errors->any())
        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
            <span class="alert-text text-white">
            {{$errors->first()}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
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
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0 mb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $page_title ?? '' }}</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; New {{ $page_title ?? '' }}</a>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New {{ $page_title ?? '' }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form role="form text-left" method="POST" action="{{ route('tambah-product') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                        <label for="">Category</label>
                                            <select name="category_id" id="" class="form-control" required>
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('nama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="">Name Product</label>
                                            <input type="text" class="form-control" placeholder="Name Product" name="nama" id="nama" required>
                                            @error('nama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="">Stok</label>
                                            <input type="integer" class="form-control" placeholder="Stok" name="stok" id="stok" required>
                                            @error('stok')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="">Price (Rp.)</label>
                                            <input type="integer" class="form-control" placeholder="Price (Rp.)" name="price" id="price" required>
                                            @error('price')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Image 1 (Thumbnail)</label>
                                            <input type="file" class="form-control" name="foto_1" id="foto_1" required>
                                            @error('foto_1')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Image 2</label>
                                            <input type="file" class="form-control" name="foto_2" id="foto_2" required>
                                            @error('foto_2')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Image 3</label>
                                            <input type="file" class="form-control" name="foto_3" id="foto_3" required>
                                            @error('foto_3')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Image 4</label>
                                            <input type="file" class="form-control" name="foto_4" id="foto_4" required>
                                            @error('foto_4')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Description</label>
                                            <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                                            @error('deskripsi')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                              </form>
                                </div>
                            </div>
                            </div>
                        </div>
  
                    </div>
                </div>
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myDataTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NO
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name Product
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stok
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image 1 (Thumbnail)
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image 2
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image 3
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image 4
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                        
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $cat = \App\Models\Category::where('id',$item->id_category)->first();
                                        @endphp
                                        {{ $cat->nama ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->stok }}
                                    </td>
                                    <td class="text-center">
                                        @currency($item->harga)
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldesc{{ $item->id }}">Show</button>
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('assets/img/foto_product/'.$item->foto_1) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('assets/img/foto_product/'.$item->foto_2) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('assets/img/foto_product/'.$item->foto_3) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('assets/img/foto_product/'.$item->foto_4) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td class="text-center">
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a href="{{ route('delete-product',$item->id) }}" type="button" >
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                           

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($product as $item2)
<div class="modal fade" id="modaldesc{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $page_title ?? '' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-product',$item2->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                {!! nl2br(e($item2->deskripsi)) !!}
            </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $page_title ?? '' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-product',$item2->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                <label for="">Category</label>
                    <select name="category_id" id="" class="form-control" required>
                        <option value="">Choose Category</option>
                        @foreach ($category as $c)
                            <option value="{{ $c->id }}" {{ $c->id == $item2->id_category ? 'selected' : '' }}>{{ $c->nama }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="">Name Product</label>
                    <input type="text" class="form-control" placeholder="Name Product" value="{{ $item2->nama }}" name="nama" id="nama" required>
                    @error('nama')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="">Stok</label>
                    <input type="integer" class="form-control" placeholder="Stok" value="{{ $item2->stok }}" name="stok" id="stok" required>
                    @error('stok')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="">Price (Rp.)</label>
                    <input type="integer" class="form-control" placeholder="Price (Rp.)" value="{{ $item2->harga }}" name="price" id="price" required>
                    @error('price')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Image 1 (Thumbnail)</label>
                    <br>
                    <img src="{{ asset('assets/img/foto_product/'.$item->foto_1) }}" alt="" style="max-width: 200px">
                    <input type="file" class="form-control" name="foto_1" id="foto_1" required>
                    @error('foto_1')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Image 2</label>
                    <br>
                    <img src="{{ asset('assets/img/foto_product/'.$item->foto_2) }}" alt="" style="max-width: 200px">
                    <input type="file" class="form-control" name="foto_2" id="foto_2" required>
                    @error('foto_2')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Image 3</label>
                    <br>
                    <img src="{{ asset('assets/img/foto_product/'.$item->foto_3) }}" alt="" style="max-width: 200px">
                    <input type="file" class="form-control" name="foto_3" id="foto_3" required>
                    @error('foto_3')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Image 4</label>
                    <br>
                    <img src="{{ asset('assets/img/foto_product/'.$item->foto_4) }}" alt="" style="max-width: 200px">
                    <input type="file" class="form-control" name="foto_4" id="foto_4" required>
                    @error('foto_4')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $item2->deskripsi }}</textarea>
                    @error('deskripsi')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        </div>
    </div>
    </div>
</div>
@endforeach

 

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myDataTable').DataTable();
    });
</script>

@endsection