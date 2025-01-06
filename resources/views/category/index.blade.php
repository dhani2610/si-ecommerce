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
                                <form role="form text-left" method="POST" action="{{ route('tambah-category') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        @csrf
                                        <div class="mb-3">
                                        <label for="">Name Category</label>
                                            <input type="text" class="form-control" placeholder="Name Category" name="nama" id="nama" required>
                                            @error('nama')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                        <label for="">Image</label>
                                            <input type="file" class="form-control" name="foto" id="foto" required>
                                            @error('foto')
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
                                        Name Category
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                <tr>
                                        
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="text-center">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('assets/img/foto_category/'.$item->foto) }}" alt="" style="max-width: 200px">
                                    </td>
                                    <td class="text-center">
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                            <i class="fa fa-pencil text-secondary"></i>
                                        </a>
                                        <a href="{{ route('delete-category',$item->id) }}" type="button" >
                                            <i class="cursor-pointer fa fa-trash text-secondary"></i>
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

@foreach ($category as $item2)
<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $page_title ?? '' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-category',$item2->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="">Name Category</label>
                            <input type="text" class="form-control" placeholder="Name Category" value="{{ $item2->nama }}" name="nama" id="nama" required>
                            @error('nama')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Image</label> <br>
                            <img src="{{ asset('assets/img/foto_category/'.$item2->foto) }}" alt="" style="max-width: 200px">
                            <br>
                            <input type="file" class="form-control" name="foto" id="foto" required>
                            @error('foto')
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