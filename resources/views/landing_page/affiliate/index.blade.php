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
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ooops!</strong> {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="row mt-4">
            <div class="col-md-7">
                <div class="card card-border border-success bg-light ps-0 w-50">
                    <div class="card-body">
                        <h5>Saldo</h5>
                        <p><span class="fw-bold text-dark saldo">Rp. @money($data->saldo_sum_amount), 00</p>
                    </div>
                </div>
                <h3 class="mt-5">Reedem Kode</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta, exercitationem? Ad mollitia magni
                    dolorum, asperiores dicta iste expedita eos odio ratione suscipit possimus voluptates quasi
                    repudiandae eum alias voluptatum atque.</p>
                <form class="row g-3" method="POST" action="{{ route('user.affiliate.confirm') }}">
                    @csrf
                    <div class="col-md-8">
                        <label for="inputPassword2" class="visually-hidden">Referal Reedem</label>
                        <input type="text" name="code" class="form-control form-control-flush" id="inputPassword2"
                            placeholder="Masukkan Kode Referal">
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
                            @forelse ($data->referal->voucher as $voucher)
                                <div class="col-md-3 m-1">
                                    <div class="container">
                                        <img width="100" height="auto" src="{{ $voucher->user->avatar }}"
                                            class="rounded" alt="{{ $voucher->user->username }}">
                                    </div>
                                </div>
                            @empty
                                <h3>Belum Memiliki Pengguna</h3>
                            @endforelse
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <p class="mt-5" id="code_inv">Kode Undangan : {{ $data->referal->code }}</p>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <button class="btn btn-sm btn-primary copy-btn" onclick="withJquery();"
                                    type="button">Salin</button>
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
        function withJquery() {
            console.time('time1');
            var temp = $("<input>");
            $("body").append(temp);
            temp.val($('#code_inv').text() + '/ {{Auth::user()->name}}').select();
            document.execCommand("copy");
            temp.remove();
            console.timeEnd('time1');
            $('.copy-btn').text('Tersalin')
        }
    </script>
@endpush
