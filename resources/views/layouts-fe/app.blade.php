<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Toko Aldi - {{ $page_title ?? '-' }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{asset('assets/img/logo-toko.png')}}" rel="icon">
    <link href="{{asset('assets/img/logo-toko.png')}}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('assets-fe/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('assets-fe/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <link href="{{ asset('assets-fe/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  @yield('style')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts-fe.partials.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @if (request()->is('/'))
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{ asset('assets-fe/img/slide/slide-1.jpg')}})">
          <div class="carousel-container">
            
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url({{ asset('assets-fe/img/slide/slide-2.jpg')}})">
          <div class="carousel-container">
           
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url({{ asset('assets-fe/img/slide/slide-3.jpg')}})">
          <div class="carousel-container">
            
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section>
  @endif
  <!-- End Hero -->
    @if (request()->is('/cart') && request()->is('/checkout') )
        <main id="main" >
    @else
        <main id="main" style="padding-top:7% ">
    @endif
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts-fe.partials.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('layouts-fe.partials.foot')
  

</body>

</html>