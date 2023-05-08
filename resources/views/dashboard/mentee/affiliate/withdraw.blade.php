@extends('dashboard.mentee.app')
@section('title-mentee', 'Penarikan Saldo')
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
                        <h3>Withdraw Saldo</h3>
                        <p class="text-subtitle text-muted">Powerful interactive tables with datatables (jQuery
                            required)</p>
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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#primary">Tarik Saldo</button>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Tipe Pembayaran</th>
                                    <th>Saldo</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraws as $withdraw)
                                    <tr>
                                        <td>{{ $withdraw->type }}</td>
                                        <td>{{ $withdraw->amount }}</td>
                                        <td>{{ $withdraw->created_at }}</td>
                                        <td>
                                            @if ($withdraw->status == 'request')
                                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                            @elseif ($withdraw->status == 'done')
                                                <span class="badge bg-success">Berhasil</span>
                                            @else
                                                <span class="badge bg-danger">Di tolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Saldo Saat Ini</h4>
                    </div>
                    <div class="card-body">
                        <h3>Rp. @money($user->saldo_sum_amount - $user->withdraw_sum_amount), 00</h3>
                    </div>
                </div>
            </section>

            {{-- Modal --}}
            <div class="modal fade text-left" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="myModalLabel160">Isi Data Berikut
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form action="{{route('mentee.affiliate.withdraw')}}" method="POST" id="request-withdraw">
                                    @csrf
                                    <div class="form-group">
                                        <label for="amount">Nominal Penarikan</label>
                                        <input type="number" class="form-control" id="amount" name="amount" max="{{$user->saldo_sum_amount}}"
                                        placeholder="Maks Penarikan {{$user->saldo_sum_amount}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Nomor Rekening / Nomor (OVO, GOPAY)</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Pilih Metode Penarikan</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="">Pilih Metode Penarikan</option>
                                            <option value="OVO">OVO</option>
                                            <option value="GOPAY">GOPAY</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BCA">BCA</option>
                                            <option value="BRI">BRI</option>
                                            <option value="BNI">BNI</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" form="request-withdraw" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Oke</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal --}}

            <script src="assets/js/bootstrap.js"></script>
            <script src="assets/js/app.js"></script>

            <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
            <script src="{{ asset('dashboard/assets/extensions/jquery/jquery.min.js') }}"></script>
            <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
            <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

            <script>
                $('#table1').DataTable();
            </script>
        </div>
    </div>
@endsection
