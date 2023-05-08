@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Withdraw')
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
                        <h3>Permintaan Penarikan</h3>
                        <p class="text-subtitle text-muted">Pilih Affiliator Untuk Detail</p>
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
                                <table class="table table-bordered mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $withdraw->user->name }}</td>
                                                <td>{{ $withdraw->user->email }}</td>
                                                <td>@money($withdraw->amount)</td>
                                                <td>{{ day($withdraw->created_at) }}</td>
                                                <td>{{ $withdraw->created_at->toTimeString() }}</td>
                                                <td>
                                                    <select name="status" id="status" data-id="{{ $withdraw->id }}"
                                                        class="form-control">
                                                        <option value="rejected"
                                                            {{ $withdraw->status == 'rejected' ? 'selected' : '' }}>Reject
                                                        </option>
                                                        <option value="done"
                                                            {{ $withdraw->status == 'done' ? 'selected' : '' }}>Done
                                                        </option>
                                                        <option value="request"
                                                            {{ $withdraw->status == 'request' ? 'selected' : '' }}>Request
                                                        </option>
                                                    </select>
                                                </td>
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
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>
    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        $('#table1').DataTable();

        $(document).on('change', '#status', function() {
            var value = $(this).val();
            var withdrawId = $(this).data('id')

            var url = '{{ route('superadmin.affiliate.withdraw.update', ':withdrawId') }}'

            url = url.replace(':withdrawId', withdrawId);

            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    '_token': token,
                    'status' : value,
                }
            })
        })
    </script>
@endpush
