@extends('dashboard.mentee.app')
@section('title-mentee', 'Affiliasi')
@section('content-mentee')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Tracking Kode</h3>
                        <p class="text-subtitle text-muted">Affiliator : {{$data->name}}</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DataTable Jquery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="detail-track">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Nama Kelas</th>
                                            <th>Harga</th>
                                            <th>Potongan Harga</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->referal->voucher as $track)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{day($track->created_at)}}</td>
                                                <td>{{$track->created_at->toTimeString()}}</td>
                                                <td>{{$track->user->username}}</td>
                                                <td>{{$track->user->email}}</td>
                                                <td>{{$track->voucher->master_class->first()->name}}</td>
                                                <td>{{$track->voucher->master_class->first()->price}}</td>
                                                <td>{{$track->voucher->nominal}}</td>
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
@endsection
