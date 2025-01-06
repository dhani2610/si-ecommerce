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
                <div class="col-lg-2">
                    <span style="font-size: 3vh;font-weight: 800;margin-bottom:10px">Filters</span> <br> <br>
                    <span style="font-size: 2vh;font-weight: 800;margin-bottom:10px">Categories</span> <br>
                    <form id="filter-form">
                    @foreach ($category as $cat)
                    <br>
                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="category-checkbox">
                    <label for="" style="    margin-left: 10px;">{{ $cat->nama }}</label>
                    @endforeach
                    </form>
                </div>
                <div class="col-lg-10">
                  <div class="row mx-auto content " id="product-list" style="max-width: 60em;">
                        @foreach ($product as $prod)
                            <div class="col-lg-4 mb-2" onclick="">
                                <div class="card" style="width: 18rem;" >
                                  <a href="{{ url('shop/detail/' . $prod->id) }}">
                                    <img src="{{ asset('assets/img/foto_product/'.$prod->foto_1) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                          <h5 class="card-title">{{ $prod->nama }}</h5>
                                          <h5 class="card-title">@currency($prod->harga)</h5>
                                    </div>
                                  </a>
                                </div>
                            </div>
                          </a>
                        @endforeach
                  </div>
                </div>
            </div>
          </div>
  
        </div>
      </section><!-- End About Section -->
  
     

@endsection
@section('script')
<script>
 document.querySelectorAll('.category-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        const form = document.getElementById('filter-form');
        const formData = new FormData(form);
        
        fetch("{{ route('shop.filter') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';
            
            if (data.products.length > 0) {
                data.products.forEach(product => {
                    const productHtml = `
                      <div class="col-lg-4 mb-2">
                          <div class="card" style="width: 18rem;" >
                            <a href="{{ url('shop/detail/') }}/${product.id}">
                              <img src="${product.foto_1}" class="card-img-top" alt="...">
                              <div class="card-body">
                                  <h5 class="card-title">${product.nama}</h5>
                                  <h5 class="card-title">${product.harga}</h5>
                              </div>
                            </a>

                          </div>
                      </div>`;
                    productList.innerHTML += productHtml;
                });
            } else {
                productList.innerHTML = `
                <div class="col-lg-4 mb-2">
                        <h5 class="card-title">Product Not Found!</h5>
                  </div>
                `;
            }
        });
    });
});

  </script>
@endsection