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
@endsection
@section('content')
     <!-- ======= About Section ======= -->
     <section id="about" class="about">
        <div class="container">
  
            <div class="row content">
                <div class="col-lg-12">
                <h2 class="text-center">Categories</h2>
                <br>

                <p class="text-center mt-2 mb-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui eligendi aspernatur ipsam minima nostrum consequatur possimus assumenda eaque dolorem et doloremque expedita quae deserunt quas facilis culpa laudantium, nemo numquam vero dolores? A autem, enim tempora mollitia officiis quis sapiente eligendi iure tenetur quo dignissimos excepturi amet consectetur, exercitationem libero.
                </p>
                <br>
                <center>
                    <a href="{{ route('shop') }}" class="btn btn-shop-all" >Shop All</a>
                </center>
            </div>
          </div>
  
        </div>
      </section><!-- End About Section -->
  
      <!-- ======= Clients Section ======= -->
      <section id="clients" class="clients section-bg">
        <div class="container">
          <div class="row mx-auto" style="max-width: 60em;">
            @foreach ($category as $cat)
                <div class="col-lg-4">
                    <div class="card mx-auto" style="width: 18rem;">
                        <img src="{{ asset('assets/img/foto_category/'.$cat->foto) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $cat->nama }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
          </div>
  
        </div>
      </section><!-- End Clients Section -->

       <!-- ======= About Section ======= -->
     <section id="about" class="about">
        <div class="container">
  
            <div class="row content">
                <div class="col-lg-12">
                <h2 class="text-center">Our Product</h2>
                <br>

                <p class="text-center mt-2 mb-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui eligendi aspernatur ipsam minima nostrum consequatur possimus assumenda eaque dolorem et doloremque expedita quae deserunt quas facilis culpa laudantium, nemo numquam vero dolores? A autem, enim tempora mollitia officiis quis sapiente eligendi iure tenetur quo dignissimos excepturi amet consectetur, exercitationem libero.
                </p>
                <br>
                <center>
                    <a href="{{ route('shop') }}" class="btn btn-shop-all" >Shop All</a>
                </center>
            </div>
          </div>
  
        </div>

      </section><!-- End About Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg about">
            <div class="container">
                <div class="row mx-auto content" style="max-width: 60em;">
                <h2 style="font-size: 2em">Sign up for our newsletter</h2>

                @foreach ($product as $prod)
                    <div class="col-lg-4 mb-2">
                        <a href="{{ url('shop/detail/' . $prod->id) }}">
                            <div class="card mx-auto" style="width: 18rem;">
                                <img src="{{ asset('assets/img/foto_product/'.$prod->foto_1) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $prod->nama }}</h5>
                                    <h5 class="card-title">@currency($prod->harga)</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
              </div>
      
            </div>
          </section><!-- End Clients Section -->
          <br>
          <br>
    

@endsection
@section('script')
    
@endsection