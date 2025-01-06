@extends('layouts-fe.app')

@section('style')
<style>
.input-ck{
    border-radius: 0px;
    padding: 10px;
    border: 1px solid black;
}
#btn-checkout{
    color: white;
    background: black;
    height: 3em;
    font-weight: 600;
    width: 100%;
    border-radius: 0px;
}
</style>
@endsection
@section('content')
<section id="about" class="about">
    <div class="container">

        <div class="row content">
            <form method="POST" action="/register">
                @csrf
            <div class="card mx-auto" style="max-width: 60vh">
                <div class="card-body">
                    <label style="color: black;font-weight:700;">Register</label> <br>
                    <label style="color: silver;">Register with email</label> <br>
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
                    <div class="form-group mt-2">
                        <input type="text" class="form-control input-ck" value="" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group mt-2">
                        <input type="email" class="form-control input-ck" value="" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-2">
                        <input type="password" class="form-control input-ck" value="" name="password" placeholder="Password">
                    </div>
                    <input type="hidden" name="role" value="role">
                    <div class="form-group mt-2">
                        <input type="number" class="form-control input-ck" value="" name="phone_number" placeholder="Phone Number">
                    </div>
                    <div class="form-group mt-2">
                        <input type="text" class="form-control input-ck" value="" name="address" placeholder="Address">
                    </div>
                    <br>
                    <br>
                    {{-- Or create an account --}}
                    <button type="submit" id="btn-checkout" class="shopnow" style="height: 3em" ><span>Register</span></button>
                </div>
                </form>
            </div>
        </div>

    </div>

</section><!-- End About Section -->
@endsection
@section('script')
    
@endsection