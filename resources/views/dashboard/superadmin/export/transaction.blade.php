@extends('dashboard.superadmin.app')
@section('title-superadmin', 'Rekapitulasi')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <!-- Basic Tables start -->
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group float-end" role="group" aria-label="Basic example">
                            <button class="btn btn-sm btn-info float-end" type="submit" form="filter">Cetak</button>
                            <button class="btn btn-sm btn-success float-end" type="button" id="filter_show">Filter</button>
                        </div>
                        <div class="container">
                            <form action="{{route('superadmin.recap.transaction')}}" method="POST" id="filter">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="date" name="start_date" class="form-control"
                                            placeholder="Tanggal Mulai">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" name="end_date" class="form-control"
                                            placeholder="Tanggal Akhir">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Kode Invoice</th>
                                        <th>Nama Pembeli</th>
                                        <th>Email Pembeli</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Master Class</th>
                                        <th>Dibayar</th>
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
            <!-- Basic Tables end -->
        </div>
    </div>
@endsection
@push('superadminscript')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('dashboard') }}/assets/js/pages/datatables.js"></script>

    <script>
        var token = $('meta[name=csrf-token]').attr('content')
        var myTable = $('#table1').DataTable();
        var url = '{{ route('superadmin.recap.transaction') }}'

        $(document).ready(function() {
            getUsers()
        })

        $('#filter_show').on('click', function(e) {
            e.preventDefault();
            var value = $('#filter').serialize()

            url = '{{ url('superadmin/recap/transactions') }}?' + value

            console.log(url)

            getUsers();
        })

        function getUsers() {
            myTable = $('#table1').DataTable({
                destroy: true,
                ajax: url,
                columns: [{
                        data: 'invoice_number'
                    },
                    {
                        data: 'user_name'
                    },
                    {
                        data: 'user_email',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'master_class_name'
                    },
                    {
                        data: 'pay',
                        render: function(data, type, row) {
                            return new Intl.NumberFormat("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            }).format(data);
                        }
                    },
                    {
                        data: 'status'
                    },
                ],
            });
        }
    </script>
@endpush
