@extends('dashboard.auth.app')
@section('form-authentication')
    <div class="card">
        <div class="card-content">
            <img src="{{asset('dashboard')}}/assets/images/samples/motorcycle.jpg" class="card-img-top img-fluid" alt="singleminded">
            <div class="card-body">
                <h5 class="card-title">Mengirim Ulang Verifikasi Email</h5>
                <p class="card-text">
                    Tingkatkan Keterampilan, Karir & Bisnis Anda Bersama kami, untuk mewujudkan SDM yang adaptif, kreatif dan inovatif di Era Digital
                </p>
                <form action="{{route('verification.send')}}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Kirim Ulang Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection
