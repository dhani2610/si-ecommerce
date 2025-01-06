<style>
    #header{
        padding: 0px!important;
    }
    #header .logo img {
        max-height: 4em;
    }
    #header .logo {
        margin: 0;
        padding: 0;
        line-height: 1;
        font-weight: 700;
        text-transform: uppercase;
        color: black;
        font-size: 23px;
        font-weight: 800;
    }
</style>
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

    <a href="/" class="logo me-auto"><img src="{{asset('assets/img/logo-toko.png')}}" alt="" class="img-fluid">Toko Aldi</a>
      {{-- <h1 class="logo me-auto"><a href="index.html">Toko Aldi</a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
        <li><a href="/" class="active">Home</a></li>
        <li><a href="{{ route('shop') }}" class="text-dark">Shop</a></li>
        @if (Auth::check() != null)
        <li><a href="{{ route('history-order') }}" class="text-dark">History Order</a></li>
        @endif

        <li><a href="{{ route('cart') }}" ><i class="fa fa-shopping-cart" style="font-size: 5vh;"></i></a></li>
        @if (Auth::check() == null)
        <li><a href="/login" class="getstarted">Login</a></li>
        @else
        <li><a href="/" class="getstarted">{{ Auth::user()->name }}</a></li>
        <li><a href="/logout" class="getstarted bg-danger"> <i class="fa fa-sign-out"></i> Logout </a></li>
        @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>