@extends('landing_page.app')
@section('app-content')
    <header class="py-8 py-md-12 overlay overlay-primary overlay-80"
        style="background-image: url({{ asset('skola/assets/img/covers/cover-19.jpg') }});">
        <div class="container text-center py-xl-5">
            <h1 class="display-4 fw-semi-bold mb-0 text-white">Let’s join as affiliator Amikom Center</h1>
            <p class="mt-3 text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="..." alt="...">
    </header>
    <div class="container pt-4 pb-4 pb-xl-7">
        <div class="row mt-4">
            <div class="col-md-7">
                <div class="card card-border border-success bg-light ps-0 w-50">
                    <div class="card-body">
                        <h5>Point</h5>
                        <p><span class="fw-bold text-dark">100</span> = <span>Rp. 10.000,00</span></p>
                    </div>
                </div>
                <h3 class="mt-5">Reedem Kode</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, exercitationem? Ad mollitia magni
                    dolorum, asperiores dicta iste expedita eos odio ratione suscipit possimus voluptates quasi
                    repudiandae eum alias voluptatum atque.</p>
                <form class="row g-3" method="POST" action="{{route('mentee.affiliate.confirm')}}">
                    @csrf
                    <div class="col-md-8">
                        <label for="inputPassword2" class="visually-hidden">Referal Reedem</label>
                        <input type="text" name="code" class="form-control form-control-flush" id="inputPassword2" placeholder="Masukkan Kode Referal">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mb-3">Konfirmasi</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="card bg-light h-100">
                    <div class="card-header pb-0">
                        <h3>Dapatkan hingga Rp100.000 karena 
                            mengundang temanmu</h3>
                    </div>
                    <div class="card-body m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img width="100" height="auto" src="https://via.placeholder.com/1000x1000.png/0099ee?text=fuga" class="rounded" alt="...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img width="100" height="auto" src="https://via.placeholder.com/1000x1000.png/0099ee?text=fuga" class="rounded" alt="...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img width="100" height="auto" src="https://via.placeholder.com/1000x1000.png/0099ee?text=fuga" class="rounded" alt="...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img width="100" height="auto" src="https://via.placeholder.com/1000x1000.png/0099ee?text=fuga" class="rounded" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <p class="mt-5">Kode Undangan : {{$data->referal->code}}</p>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <button class="btn btn-sm btn-primary">Undang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
@push('app-script')
    <script>
        $(document).ready(function(){
            console.log('ready')
        })
    </script>
@endpush