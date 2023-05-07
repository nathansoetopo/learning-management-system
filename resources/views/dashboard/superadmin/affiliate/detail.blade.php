@extends('dashboard.superadmin.app')
@section('title', 'Affiliasi')
@section('content')
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
                        <h3>{{ $referal->code }}</h3>
                        <p class="text-subtitle text-muted">List Reedem, Saldo Masuk, Saldo Keluar</p>
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
                    <div class="card-header">
                        <h4>Reedem Code</h4>
                    </div>
                    <div class="card-body">
                        <div class="detail-track">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="table1">
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
                                        @foreach ($referal->voucher as $track)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ day($track->created_at) }}</td>
                                                <td>{{ $track->created_at->toTimeString() }}</td>
                                                <td>{{ $track->user->username }}</td>
                                                <td>{{ $track->user->email }}</td>
                                                <td>{{ $track->voucher->master_class->first()->name }}</td>
                                                <td>@money($track->voucher->master_class->first()->price)</td>
                                                <td>@money($track->voucher->nominal)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Saldo Masuk</h4>
                    </div>
                    <div class="card-body">
                        <div class="detail-track">
                            <table class="table table-bordered mb-0" id="table2">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Saldo</th>
                                        <th>Time</th>
                                        <th>Komisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Content --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Withdraw</h4>
                    </div>
                    <div class="card-body">
                        <div class="detail-track">
                            <table class="table table-bordered mb-0" id="table3">
                                <thead>
                                    <tr>
                                        <th>Tipe Pembayaran</th>
                                        <th>Saldo</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Content --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')

        $(document).ready(function() {
            $('#table1').DataTable();
            loadIncome();
            loadWithdraw();
        })

        function loadIncome() {
            incomeTable = $('#table2').DataTable({
                destroy: true,
                ajax: '{{ route('superadmin.affiliate.income', ['user_id' => $referal->user->id]) }}',
                columns: [{
                        data: 'username'
                    },
                    {
                        data: 'total_running'
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'amount',
                    }
                ],
            });
        }

        function loadWithdraw() {
            incomeTable = $('#table3').DataTable({
                destroy: true,
                ajax: '{{ route('superadmin.affiliate.withdraw', ['user_id' => $referal->user->id]) }}',
                columns: [{
                        data: 'type'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'status',
                    }
                ],
            });
        }
    </script>
@endpush
